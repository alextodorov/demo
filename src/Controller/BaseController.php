<?php
namespace Application\Controller;

class BaseController
{
    protected array $config;
    protected array $data;
    public function __construct($config)
    {
        $this->config = $config;
        $this->data = json_decode(file_get_contents('php://input'), true) ?? [];
    }
}