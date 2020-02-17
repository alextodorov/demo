<?php
namespace Application\Interfaces;

interface PriceInterface
{
    public function setPricing(array $products);
    public function scanItems();
    public function scanItem(string $code);
    public function getTotal(): float;
}