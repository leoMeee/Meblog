<?php

namespace app\modules\backend\controllers;

use app\modules\backend\models\Tag;

class TagController extends BaseController
{
    public function actionTag()
    {
        return $this->render('tag');
    }

}
