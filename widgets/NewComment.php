<?php
/*
 * 最新评论
 * @author     wanglei@wyzc.com
 * @created_at    16/4/27 上午10:51
 */
namespace app\widgets;

use yii\base\Widget;
use app\models\Comment as CommentModel;

class NewComment extends Widget
{
    private $comments;
    private $count = 10;

    public function init()
    {
        parent::init();
        $query = CommentModel::find()->orderBy(['created_at' => SORT_DESC]);
        $this->comments = $query->limit($this->count)->all();

    }

    public function run()
    {
        return $this->render(
            'new-comment',
            [
                'comments' => is_array($this->comments) ? $this->comments : array(),
            ]
        );
    }
}