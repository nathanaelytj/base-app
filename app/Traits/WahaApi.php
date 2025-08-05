<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait WahaApi
{
    /**
     * Check if a contact exists in Waha API.
     */
    private function wahaCheckContactExists(string $phone): ?array
    {
        $session = config('services.waha.session', 'default');
        $baseUrl = config('services.waha.base_url');
        if (! $baseUrl) {
            throw new \Exception('Waha API base_url is not set in services.php');
        }
        $response = Http::get("{$baseUrl}/api/contacts/check-exists", [
            'phone' => $phone,
            'session' => $session,
        ]);
        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    /**
     * Send 'seen' status to a chat via Waha API.
     */
    private function wahaSendSeen(string $chatId): void
    {
        $session = config('services.waha.session', 'default');
        $baseUrl = config('services.waha.base_url');
        if (! $baseUrl) {
            throw new \Exception('Waha API base_url is not set in services.php');
        }
        $response = Http::post("{$baseUrl}/api/sendSeen", [
            'session' => $session,
            'chatId' => $chatId,
        ]);
        Log::debug('WahaApi sendSeen response', [
            'response' => $response->json(),
        ]);
    }

    /**
     * Start typing presence for a chat via Waha API.
     */
    private function wahaStartTyping(string $chatId): void
    {
        $session = config('services.waha.session', 'default');
        $baseUrl = config('services.waha.base_url');
        if (! $baseUrl) {
            throw new \Exception('Waha API base_url is not set in services.php');
        }
        $response = Http::post("{$baseUrl}/api/startTyping", [
            'chatId' => $chatId,
            'session' => $session,
        ]);
        Log::debug('WahaApi startTyping response', [
            'response' => $response->json(),
        ]);
    }

    /**
     * Stop typing presence for a chat via Waha API.
     */
    private function wahaStopTyping(string $chatId): void
    {
        $session = config('services.waha.session', 'default');
        $baseUrl = config('services.waha.base_url');
        if (! $baseUrl) {
            throw new \Exception('Waha API base_url is not set in services.php');
        }
        $response = Http::post("{$baseUrl}/api/stopTyping", [
            'chatId' => $chatId,
            'session' => $session,
        ]);
        Log::debug('WahaApi stopTyping response', [
            'response' => $response->json(),
        ]);
    }

    /**
     * Send a text message to a chat via Waha API.
     */
    private function wahaSendText(string $chatId, string $text): void
    {
        $session = config('services.waha.session', 'default');
        $baseUrl = config('services.waha.base_url');
        if (! $baseUrl) {
            throw new \Exception('Waha API base_url is not set in services.php');
        }
        $response = Http::post("{$baseUrl}/api/sendText", [
            'session' => $session,
            'chatId' => $chatId,
            'text' => $text,
        ]);
        Log::debug('WahaApi sendText response', [
            'response' => $response->json(),
        ]);
    }
}
