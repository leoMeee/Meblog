<?php

namespace app\modules\backend\controllers;

use app\modules\backend\models\Comment;

class CommentController extends BaseController
{
    public function actionComment()
    {
        return $this->render('comment');
    }

}
