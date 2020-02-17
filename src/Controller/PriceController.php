<?php
declare(strict_types=1);
namespace Application\Controller;

use Application\Entities\Products;
use Application\Model\PriceModelFactory;

class PriceController extends BaseController
{
    public function indexAction()
    {
        $priceModel = PriceModelFactory::create($this->data);
        $priceModel->setPricing(Products::getProducts($this->data));
        $priceModel->scanItems();

        echo json_encode(['price' => $priceModel->getTotal()]);
    }
}