<?php
namespace app\modules\frontendApi\controllers;

use yii\rest\Controller;
use Yii;

class PostController extends Controller
{
    
    public function actionIndex()
    {
        $posts = [
            [
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
            [
                'title' => 'linux从入门到精通',
                'created_at' => time(),
            ],
        ];
        return $posts;
    }

    public function actionView($id)
    {
        return $id;
    }

}
