<?php
/*
 * 日志控制器
 * @author     wanglei@wyzc.com
 * @created_at    16/4/21 上午10:51
 */
namespace app\controllers;

use yii\web\Controller;
use app\models\Post;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\filters\AccessControl;
use Yii;

class PostController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * 日志列表
     * @return string
     */
    public function actionIndex()
    {
        $query = Post::find()->search(Yii::$app->request->get());
        if (Yii::$app->user->isGuest) {
            $query->published();
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index', compact('models', 'pages'));
    }

    /**
     * 日志详情
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionShow($id)
    {
        $model = $this->findModel($id);

        return $this->render('show', compact('model'));
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
