<?php
namespace app\modules\frontendApi\controllers;

use app\components\RestController;
use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PostController extends RestController
{

    public function actionIndex()
    {
        return new ActiveDataProvider(
            [
                'query' => Post::find(),
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],
            ]
        );

    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $model;
    }

    private function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('这个页面没有找到');
        }
    }

}
