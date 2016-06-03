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
    

    private function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('这个页面没有找到');
        }
    }
}
