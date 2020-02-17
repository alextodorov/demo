<?php
namespace Application\Entities;

class Products
{
    private const PRODUCTS = [
        'ZA' => [
            'price' => 2.00,
            'volume' => [
                'count' => 4,
                'price' => 7.00,
            ],
        ],
        'YB' => [
            'price' => 12.00,
        ],
        'FC' => [
            'price' => 1.25,
            'volume' => [
                'count' => 6,
                'price' => 6.00,
            ],
        ],
        'GD' => [
            'price' => 0.15,
        ],
    ];

    public static function getProducts(array $orders): array
    {
        $result = [];

        foreach ($orders as $code) {
            if (isset(self::PRODUCTS[$code])) {
                $result[$code] = self::PRODUCTS[$code];
            }
        }

        return $result;
    }
}