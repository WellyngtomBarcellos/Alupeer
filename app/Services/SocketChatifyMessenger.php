<?php

namespace App\Services;

use Chatify\ChatifyMessenger;
use Illuminate\Support\Facades\Http;

class SocketChatifyMessenger extends ChatifyMessenger
{
    public function __construct()
    {
        // Intentionally skip Pusher initialization.
    }

    /**
     * Broadcast an event to the Socket.IO server (internal network).
     */
    public function push($channel, $event, $data)
    {
        $base = rtrim((string) config('chatify.socket.internal_url'), '/');
        $secret = (string) config('chatify.socket.secret');

        if ($base === '' || $secret === '') {
            return null;
        }

        try {
            return Http::withToken($secret)
                ->timeout(5)
                ->post($base . '/internal/emit', [
                    'channel' => $channel,
                    'event' => $event,
                    'data' => $data,
                ]);
        } catch (\Throwable $e) {
            report($e);

            return null;
        }
    }

    /**
     * Legacy Pusher auth endpoint — unused with Socket.IO.
     */
    public function pusherAuth($requestUser, $authUser, $channelName, $socket_id)
    {
        return response()->json(['message' => 'Not used'], 400);
    }

    /**
     * Signed handshake token for Socket.IO (userId|exp|hmac).
     */
    public static function socketToken(?int $userId): string
    {
        if (!$userId) {
            return '';
        }

        $secret = (string) config('chatify.socket.secret');
        if ($secret === '') {
            return '';
        }

        $exp = now()->addHours(12)->getTimestamp();
        $payload = $userId . '|' . $exp;
        $sig = hash_hmac('sha256', $payload, $secret);

        return $payload . '|' . $sig;
    }
}
