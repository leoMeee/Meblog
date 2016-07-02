<?php
namespace app\models\queries;

use app\models\Post;
use yii\db\ActiveQuery;

class PostQuery extends ActiveQuery
{
    public function published()
    {
        return $this->andWhere(['status' => Post::PUBLISHED]);
    }

}