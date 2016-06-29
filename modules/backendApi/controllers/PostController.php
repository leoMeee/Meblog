<?php
/*
 * 日志管理
 * @author     wanglei@wyzc.com
 * @created_at    16/6/29 下午2:03
 */
namespace app\modules\backendApi\controllers;


use Yii;
use app\modules\backendApi\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\helpers\Response;

class PostController extends BaseController
{

    /**
     * 查询日志
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        return new ActiveDataProvider(
            [
                'query' => Post::find()->select(['id', 'title', 'created_at', 'status']),
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

    /**
     * 创建日志
     * @return array
     */
    public function actionCreate()
    {
        $model = new Post();
        $model->scenario = Post::SCENARIO_CREATE;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return Response::success($model);
        } else {
            return Response::error($model->errors);
        }
    }

    /**
     * 更新日志
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Post::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return Response::success($model);
        } else {
            return Response::error($model->errors);
        }
    }

    /**
     * 更新日志属性
     * @param $id
     * @param $attribute
     * @param $attribute_value
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionUpdateAttribute($id, $attribute, $attribute_value)
    {
        $model = $this->findModel($id);
        $model->scenario = 'scenario_update_'.$attribute;
        $model->$attribute = $attribute_value;
        $model->save();

        return Response::success($model);
    }

    /**
     * 删除日志
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return Response::success();
    }

    /**
     * 日志详情
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
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
