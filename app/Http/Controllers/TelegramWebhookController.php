<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request) {
        $update = $request->all();

        // 1. Check if the message is a "/start" command with our parameter
        if (isset($update['message']['text'])) {
            $text = $update['message']['text']; // e.g., "/start 42"
            $chatId = $update['message']['chat']['id'];

            if (str_contains($text, '/start')) {
                // Extract the Laravel User ID (the "42" part)
                $laravelUserId = str_replace('/start ', '', $text);

                // 2. Find the user and save their Telegram Chat ID
                $user = User::find($laravelUserId);
                if ($user) {
                    $user->update(['telegram_chat_id' => $chatId]);

                    // (Optional) Send a confirmation back via the Bot API
                    // Use a simple Guzzle/Http request here to say "Linked!"
                }
            }
        }

        return response('OK', 200);
    }
}
