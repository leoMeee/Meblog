<?php
/*
 * 评论widget
 * @author     wanglei@wyzc.com
 * @created_at    16/4/26 下午2:59
 */
namespace app\widgets;

use yii\base\Widget;
use app\models\Comment as CommentModel;
use yii\data\Pagination;
use app\assets\CommentWidgetAsset;

class Comment extends Widget
{
    public $post_id = 0;
    private $comments;
    private $pages;

    public function init()
    {
        parent::init();
        $query = CommentModel::find()->where(['post_id' => $this->post_id])->orderBy(['created_at' => SORT_DESC]);
        $this->pages = new Pagination(['totalCount' => $query->count(), 'defaultPageSize' => 10]);
        $this->comments = $query->offset($this->pages->offset)->limit($this->pages->limit)->all();

    }

    public function run()
    {
        CommentWidgetAsset::register($this->view);
        $model = new CommentModel();
        $model->post_id = $this->post_id;

        return $this->render(
            'comment',
            [
                'model' => $model,
                'pages' => $this->pages,
                'comments' => is_array($this->comments) ? $this->comments : array(),
            ]
        );
    }
}