<?php
namespace Application\Model;

class PriceModelFactory
{
    public static function create(array $data)
    {
        return new PriceModel($data);
    }
}