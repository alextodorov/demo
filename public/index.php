<?php
use Application\Application;

include __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../config/config.php';

Application::init($config)->run();