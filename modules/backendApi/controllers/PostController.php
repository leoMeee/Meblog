<?php

namespace app\modules\backend\controllers;

use app\modules\backend\models\Post;
use yii\web\NotFoundHttpException;
use Yii;

class PostController extends BaseController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 创建日志
     */
    public function actionCreate()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['show', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));

    }

    /**
     * 更新日志
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['show', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }


    /**
     * 删除日志
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $this->redirect(['index']);
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
