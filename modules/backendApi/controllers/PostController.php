<?php
/*
 * 日志管理
 * @author     wanglei@wyzc.com
 * @created_at    16/6/29 下午2:03
 */
namespace app\modules\backendApi\controllers;


use Yii;
use app\modules\backendApi\models\Post;
use app\models\searches\PostSearch;
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
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
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
     * 批量删除日志
     * @param $ids
     * @return int
     */
    public function actionDeleteBatch($ids)
    {
        $ids = explode(',', $ids);
        if (!is_array($ids)) {
            Response::error('不合法的参数:ids');
        }

        return Post::deleteAll(['id' => $ids]);
    }

    /**
     * 批量更新日志
     * @return int
     */
    public function actionUpdateBatch()
    {
        $data = Yii::$app->request->post('data');
        $data = json_decode($data, true);
        if (!is_array($data)) {
            Response::error('不合法的参数:data');
        }
        $success_ids = [];
        $error_ids = [];
        foreach ($data as $id => $item) {
            if (($model = Post::findOne($id)) && $model->load($item, '') && $model->save()) {
                $success_ids[] = $id;
            } else {
                $error_ids[] = $id;
            }
        }

        return Response::success(compact('success_ids', 'error_ids'));
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
