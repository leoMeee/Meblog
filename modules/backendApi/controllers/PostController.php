<?php
namespace app\modules\backendApi\controllers;


use Yii;
use app\modules\backendApi\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PostController extends BaseController
{

    public function actionIndex()
    {
        return new ActiveDataProvider(
            [
                'query' => Post::find(),
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],

            ]
        );

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
