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

    public function search($params)
    {
        $this->orderBy(['created_at' => SORT_DESC]);
        $this->andFilterWhere(['like', 'title', isset($params['title']) ? $params['title'] : null]);
        $this->andFilterWhere(['like', 'tags', isset($params['tag']) ? $params['tag'] : null]);

        return $this;
    }
}