<?php
namespace app\modules\backendApi\controllers;

use app\components\RestController;

class BaseController extends RestController
{
    public function fields()
    {
        $fields = parent::fields();

        $fields['key'] = $fields['id'];

        return $fields;

    }
}