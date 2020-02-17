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
            'pass' => '&sdjo1', //c2VjcmV0X3VzZXI6JnNkam8x
        ],
        'api_key' => 'access-token-api',
        'secret_key' => 'just_key',
        'vector' => 'new_vector',
    ],
];
//curl -X POST http://localhost:9999/get-token -i -H 'Content-type: application/json' -H 'Authorization: Bearer c2VjcmV0X3VzZXI6JnNkam8x'
//eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJ1c2VyIjp0cnVlLCJleHAiOjE1ODQ2NTIyNTl9.WUVPakg4OVVoOXBmelg4Q3U5ZHB6THZnSlRvRnNLK3A4UXFRNFlXQmg1R05jak51UHpENTQ1N1B2Q3E3NkRxWWpheWNwM2ZpU2wzZ2V4MFBOYWJtcnhHVGtBYWhSVHhUaFlKQUtnSGJZV0xTczlVZkVPMkFDalc2RVlIR1ZqYzZWTVNINlhYQmVYMDRPOUp1VytUQVZRPT0=

//curl -X POST http://localhost:9999/ -i -H 'Content-type: application/json' -H 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJ1c2VyIjp0cnVlLCJleHAiOjE1ODQ2NTIyNTl9.WUVPakg4OVVoOXBmelg4Q3U5ZHB6THZnSlRvRnNLK3A4UXFRNFlXQmg1R05jak51UHpENTQ1N1B2Q3E3NkRxWWpheWNwM2ZpU2wzZ2V4MFBOYWJtcnhHVGtBYWhSVHhUaFlKQUtnSGJZV0xTczlVZkVPMkFDalc2RVlIR1ZqYzZWTVNINlhYQmVYMDRPOUp1VytUQVZRPT0='  -d '["ZA", "ZA"]'
