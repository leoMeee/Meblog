<?php

namespace app\modules\backend\controllers;

use app\modules\backend\models\User;

class UserController extends BaseController
{
    public function actionUser()
    {
        return $this->render('user');
    }

}
