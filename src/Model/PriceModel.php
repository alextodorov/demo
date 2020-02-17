<?php
declare(strict_types=1);
namespace Application\Model;

use Application\Interfaces\PriceInterface;

class PriceModel implements PriceInterface
{
    private ?array $inputs = [];
    private array $products = [];

    public function __construct(array $data)
    {
        $this->inputs = $data;
    }

    public function setPricing(array $products)
    {
        $this->products = $products;
    }

    public function scanItems()
    {
        foreach ($this->inputs as $code) {
            $this->scanItem($code);
        }
    }

    public function scanItem(string $code)
    {
        if (!isset($this->products[$code])) {
            return;
        }

        if (!isset($this->orders[$code])) {
            $this->orders[$code] = 1;
        } else {
            $this->orders[$code]++;
        }
    }

    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->orders as $code => $count) {
            if (isset($this->products[$code]['volume']) && $this->products[$code]['volume']['count'] <= $count) {
                $number = floor($count / $this->products[$code]['volume']['count']);
                $volumePrice = $number * $this->products[$code]['volume']['price'];
                $regularPrice = ($count - ($number * $this->products[$code]['volume']['count'])) * $this->products[$code]['price'];
                $total += ($volumePrice + $regularPrice);
            } else {
                $total += ($count * $this->products[$code]['price']);
            }
        }

        return $total;
    }
}