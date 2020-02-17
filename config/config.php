<?php
return [
    'routes' => [
        '/' => [
            'method' => 'POST',
            'call' => [\Application\Controller\PriceController::class, 'indexAction'],
        ],
        '/get-token' => [
            'method' => 'POST',
            'call' => [\Application\Controller\AuthController::class, 'indexAction'],
        ],
    ],
    'auth' => [
        'credentials' => [
            'user' => 'secret_user',
            'pass' => '&sdjo1',
        ],
        'api_key' => 'access-token-api',
        'secret_key' => 'just_key',
        'vector' => 'new_vector',
    ],
];