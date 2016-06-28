<?php
namespace app\modules\backendApi\controllers;


use Yii;
use app\modules\backendApi\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\helpers\Response;

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

    public function actionCreate()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return Response::success($model);
        } else {
            return Response::error($model->errors);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return Response::success($model);
        } else {
            return Response::error($model->errors);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return Response::success();
    }

    public function actionView($id)
    {
        return $this->findModel($id);
    }

    private function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }

}
