<?php
declare(strict_types=1);
namespace Application\Controller;

use Application\Model\AccessModel;

class AuthController extends BaseController
{
    public function indexAction()
    {
        $model = new AccessModel($this->config);

        echo json_encode(['token' => $model->getAccessToken()]);
    }
}