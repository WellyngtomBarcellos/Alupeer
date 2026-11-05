import http from "node:http";
import crypto from "node:crypto";
import express from "express";
import { Server } from "socket.io";

const PORT = Number(process.env.PORT || 3001);
const SECRET = process.env.SOCKET_SERVER_SECRET || "";
const ALLOWED_ORIGIN = process.env.SOCKET_ALLOWED_ORIGIN || "*";
const PRESENCE_ROOM = "presence-activeStatus";

if (!SECRET) {
  console.error("[socket] SOCKET_SERVER_SECRET is required");
  process.exit(1);
}

const app = express();
const server = http.createServer(app);

const io = new Server(server, {
  path: "/socket.io/",
  cors: {
    origin: ALLOWED_ORIGIN === "*" ? true : ALLOWED_ORIGIN.split(",").map((s) => s.trim()),
    methods: ["GET", "POST"],
    credentials: true,
  },
  transports: ["websocket", "polling"],
  pingInterval: 25000,
  pingTimeout: 20000,
});

app.use(express.json({ limit: "256kb" }));

function verifySocketToken(token) {
  if (!token || typeof token !== "string") return null;
  const parts = token.split("|");
  if (parts.length !== 3) return null;

  const [userIdStr, expStr, sig] = parts;
  const userId = Number(userIdStr);
  const exp = Number(expStr);
  if (!Number.isInteger(userId) || userId <= 0 || !Number.isInteger(exp)) return null;
  if (Date.now() / 1000 > exp) return null;

  const expected = crypto
    .createHmac("sha256", SECRET)
    .update(`${userIdStr}|${expStr}`)
    .digest("hex");

  const a = Buffer.from(sig, "utf8");
  const b = Buffer.from(expected, "utf8");
  if (a.length !== b.length || !crypto.timingSafeEqual(a, b)) return null;

  return userId;
}

function privateRoom(userId) {
  return `private-chatify.${userId}`;
}

// --- Presence ref-count (multiple tabs per user) ---
const presenceUsers = new Map(); // userId -> Set<socketId>

function presenceJoin(socket, userId) {
  socket.join(PRESENCE_ROOM);
  let set = presenceUsers.get(userId);
  const isFirst = !set || set.size === 0;
  if (!set) {
    set = new Set();
    presenceUsers.set(userId, set);
  }
  set.add(socket.id);

  if (isFirst) {
    socket.to(PRESENCE_ROOM).emit("member_added", {
      id: userId,
      user_info: { name: socket.data.userName || String(userId) },
    });
  }
}

function presenceLeave(socket, userId) {
  const set = presenceUsers.get(userId);
  if (!set) return;
  set.delete(socket.id);
  if (set.size === 0) {
    presenceUsers.delete(userId);
    io.to(PRESENCE_ROOM).emit("member_removed", {
      id: userId,
      user_info: { name: socket.data.userName || String(userId) },
    });
  }
}

io.use((socket, next) => {
  const userId = verifySocketToken(socket.handshake.auth?.token);
  if (!userId) {
    return next(new Error("unauthorized"));
  }
  socket.data.userId = userId;
  socket.data.userName = socket.handshake.auth?.name || String(userId);
  next();
});

io.on("connection", (socket) => {
  const userId = socket.data.userId;

  socket.join(privateRoom(userId));
  presenceJoin(socket, userId);

  // Client-to-client ephemeral events (typing, seen, contactItem, ...)
  // Mirrors Pusher channel.trigger: emit into the recipient's private room.
  socket.on("client-event", (payload) => {
    if (!payload || typeof payload !== "object") return;
    const { event, to_id: toId, data } = payload;
    if (typeof event !== "string" || !event.startsWith("client-")) return;
    if (!Number.isInteger(Number(toId))) return;

    io.to(privateRoom(Number(toId))).emit(event, {
      ...(data && typeof data === "object" ? data : {}),
      from_id: data?.from_id ?? userId,
    });
  });

  // Direct helpers (same contract as client-event)
  socket.on("client-typing", (data) => relayClient(socket, "client-typing", data));
  socket.on("client-seen", (data) => relayClient(socket, "client-seen", data));
  socket.on("client-contactItem", (data) => relayClient(socket, "client-contactItem", data));
  socket.on("client-messageDelete", (data) => relayClient(socket, "client-messageDelete", data));
  socket.on("client-deleteConversation", (data) => relayClient(socket, "client-deleteConversation", data));

  socket.on("disconnect", () => {
    presenceLeave(socket, userId);
  });
});

function relayClient(socket, event, data) {
  if (!data || typeof data !== "object") return;
  const toId = Number(data.to_id ?? data.to);
  if (!Number.isInteger(toId) || toId <= 0) return;
  io.to(privateRoom(toId)).emit(event, {
    ...data,
    from_id: data.from_id ?? socket.data.userId,
  });
}

// Internal API: Laravel -> Socket.IO (Chatify::push)
app.post("/internal/emit", (req, res) => {
  const auth = req.headers.authorization || "";
  const token = auth.startsWith("Bearer ") ? auth.slice(7) : "";
  if (!token || !safeEqual(token, SECRET)) {
    return res.status(401).json({ error: "unauthorized" });
  }

  const { channel, event, data } = req.body || {};
  if (typeof channel !== "string" || typeof event !== "string" || !channel || !event) {
    return res.status(400).json({ error: "channel and event are required" });
  }

  io.to(channel).emit(event, data ?? {});
  return res.json({ ok: true });
});

app.get("/health", (_req, res) => {
  res.json({ status: "ok", connections: io.engine.clientsCount });
});

function safeEqual(a, b) {
  const bufA = Buffer.from(String(a), "utf8");
  const bufB = Buffer.from(String(b), "utf8");
  if (bufA.length !== bufB.length) return false;
  return crypto.timingSafeEqual(bufA, bufB);
}

server.listen(PORT, "0.0.0.0", () => {
  console.log(`[socket] listening on :${PORT}`);
  console.log(`[socket] allowed origin: ${ALLOWED_ORIGIN}`);
});
