# syntax=docker/dockerfile:1

FROM node:22-alpine AS base

WORKDIR /app

COPY socket-server/package.json socket-server/package-lock.json* ./
RUN npm install --omit=dev

COPY socket-server/server.js ./

RUN chown -R node:node /app

ENV NODE_ENV=production \
    PORT=3001

EXPOSE 3001

USER node

CMD ["node", "server.js"]
