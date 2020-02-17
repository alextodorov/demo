<?php
namespace Application\Interfaces;

interface AuthInterface
{
    public function getAccessToken(): string;
    public function checkAccess(string $token);
    public function generateAccessToken(): string;
}