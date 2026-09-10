<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function isEnabled(): bool
    {
        return (bool) config('sms.enabled') && ! empty(config('sms.api_key'));
    }

    public function send(string $phone, string $message): bool
    {
        if (! $this->isEnabled()) {
            Log::info('SMS skipped (not configured): ' . substr($message, 0, 80));

            return false;
        }

        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) === 10) {
            $phone = '91' . $phone;
        }

        try {
            return match (config('sms.provider')) {
                'msg91' => $this->sendViaMsg91($phone, $message),
                default => $this->sendViaGeneric($phone, $message),
            };
        } catch (\Throwable $e) {
            Log::warning('SMS send failed: ' . $e->getMessage());

            return false;
        }
    }

    public function notifyNewOrder(string $orderNo, string $customerName, string $total, string $customerPhone): array
    {
        $sent = ['admin' => false, 'customer' => false];

        $admin = config('sms.admin_phone');
        if ($admin) {
            $sent['admin'] = $this->send(
                $admin,
                "🔔 NEW ORDER {$orderNo} from {$customerName}. Total Rs {$total}. Call {$customerPhone}. Ganesh Restaurant"
            );
        }

        if ($customerPhone) {
            $sent['customer'] = $this->send(
                $customerPhone,
                "Thank you {$customerName}! Order {$orderNo} received at Ganesh Restaurant. Total Rs {$total}. We will call you shortly to confirm."
            );
        }

        return $sent;
    }

    private function sendViaMsg91(string $phone, string $message): bool
    {
        $response = Http::withHeaders([
            'authkey' => config('sms.api_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.msg91.com/api/v5/flow/', [
            'template_id' => config('sms.template_order'),
            'recipients' => [['mobiles' => $phone, 'message' => $message]],
        ]);

        return $response->successful();
    }

    private function sendViaGeneric(string $phone, string $message): bool
    {
        $url = env('SMS_API_URL');
        if (! $url) {
            return false;
        }

        $response = Http::withToken(config('sms.api_key'))->post($url, [
            'to' => $phone,
            'message' => $message,
            'sender' => config('sms.sender_id'),
        ]);

        return $response->successful();
    }
}
