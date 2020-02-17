<?php
namespace Application\Interfaces;

interface AuthInterface
{
    public function getAccessToken();
    public function checkAccess(string $token);
    public function generateAccessToken(): string;
}