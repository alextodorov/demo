<?php
declare(strict_types=1);

namespace Application;

use Application\Model\AccessModel;

final class Application
{
    private static ?self $instance = null;
    private array $routes = [];
    private array $auth = [];
    private function __construct(array $config)
    {
        $this->routes = $config['routes'] ?? null;
        $this->auth = $config['auth'] ?? null;
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    public static function init(array $config)
    {
        if (!self::$instance) {
            self::$instance = new self($config);

            return self::$instance;
        }

        return self::$instance;
    }

    public function run()
    {
        $this->runHttp();
    }

    private function runHttp()
    {
        header('Content-type:application/json');

        if (!isset($this->routes[$_SERVER['REQUEST_URI']]) || $this->routes[$_SERVER['REQUEST_URI']]['method'] !== $_SERVER['REQUEST_METHOD'] ) {
            header('HTTP/1.1 404 NOT FOUND');
            return json_encode('404 Not Found!');
        }

        $class = $this->routes[$_SERVER['REQUEST_URI']]['call'][0];

        try {
            if ($_SERVER['REQUEST_URI'] !== '/get-token') {
                $accessModel = new AccessModel($this->auth);

                $accessModel->checkAccess($_SERVER['HTTP_AUTHORIZATION']);
            }

            call_user_func([new $class($this->auth), $this->routes[$_SERVER['REQUEST_URI']]['call'][1]]);
        } catch (\Exception $e) {
            header('HTTP/1.1 401 Unauthorized Error');
            echo json_encode($e->getMessage());
        }
    }
}