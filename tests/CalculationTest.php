<?php
use PHPUnit\Framework\TestCase;

class CalculationTest extends TestCase
{
    /**
     * @dataProvider getData
     */
    public function testCalculation(array $input, array $products, float $expected)
    {
        $model = \Application\Model\PriceModelFactory::create($input);
        $model->setPricing($products);
        $model->scanItems();
        $this->assertSame($expected, $model->getTotal());
    }

    public function getData()
    {
        return [
            [
                ['ZA', 'YB', 'FC', 'GD', 'ZA', 'YB', 'ZA', 'ZA'],
                [
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
                ],
                32.40,
            ],
            [
                ['FC', 'FC', 'FC', 'FC', 'FC', 'FC', 'FC'],
                [
                    'FC' => [
                        'price' => 1.25,
                        'volume' => [
                            'count' => 6,
                            'price' => 6.00,
                        ],
                   ]
                ],
                7.25,
            ],
            [
                ['ZA', 'YB', 'FC', 'GD'],
                [
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
                ],
                15.40,
            ]
        ];
    }
}