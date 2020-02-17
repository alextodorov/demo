<?php
declare(strict_types=1);
namespace Application\Model;

use Application\Interfaces\AuthInterface;

class AccessModel implements AuthInterface
{
    private const CRYPT_METHOD = 'AES-256-CBC';
    private const EXPIRE = 60 * 60 * 24 * 31;
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getAccessToken(): string
    {
        $header = $_SERVER['HTTP_AUTHORIZATION'];
        $auth = explode(' ', $header);
        $auth = base64_decode($auth[1]);
        $auth = explode(':', $auth);

        if (count($auth) !== 2 || $auth[0] !== $this->config['credentials']['user'] || $auth[1] !== $this->config['credentials']['pass']) {
            throw new \Exception('Unauthorized Access');
        }

        return $this->generateAccessToken();
    }

    public function checkAccess(string $token)
    {
        if (empty($token)) {
            throw new \Exception('Unauthorized Access');
        }

        $jwt = explode('.', $token);

        if (count($jwt) !== 3) {
            throw new \Exception('Unauthorized Access');
        }

        $signature = openssl_decrypt(base64_decode($jwt[2]), self::CRYPT_METHOD, $this->getSecretKeyHash(), 0,$this->getInitializationVectorHash());

        if (!$signature) {
            throw new \Exception('Unauthorized Access');
        }

        $data = explode('.', $signature);
        $msgH = json_decode(base64_decode($data[0]), true);
        $msgB = json_decode(base64_decode($data[1]), true);

        if ($msgH['typ'] !== 'JWT' || $msgH['alg'] !== 'ES256') {
            throw new \Exception('Unauthorized Access');
        }

        if ($msgB['exp'] < time()) {
            throw new \Exception('Unauthorized Access');
        }
    }

    public function generateAccessToken(): string
    {
        $header = ['typ' => 'JWT', 'alg' => 'ES256'];
        $payload = [
            "iss" => "localhost",
            "user" => true,
            'exp' => time() + self::EXPIRE,
        ];
        $segments = array();
        $segments[] = base64_encode(json_encode($header));
        $segments[] = base64_encode(json_encode($payload));
        $signing_input = implode('.', $segments);

        $token = openssl_encrypt($signing_input, self::CRYPT_METHOD, $this->getSecretKeyHash(), 0, $this->getInitializationVectorHash());

        if ($token === false) {
            throw new \Exception('Uknown exception');
        }

        $segments[] = base64_encode($token);

        return implode('.', $segments);
    }

    private function getSecretKeyHash(): string
    {
        return md5($this->config['secret_key']);
    }

    private function getInitializationVectorHash(): string
    {
        return substr(hash('sha256', $this->config['vector']), 5, 16);
    }
}