<?php

return [
    'enabled' => env('SMS_ENABLED', false),
    'provider' => env('SMS_PROVIDER', 'msg91'),
    'api_key' => env('SMS_API_KEY'),
    'sender_id' => env('SMS_SENDER_ID', 'GANESH'),
    'admin_phone' => env('SMS_ADMIN_PHONE', '9276819283'),
    'template_order' => env('SMS_TEMPLATE_ORDER', 'order_notify'),
];
