<?php
namespace app\modules\backendApi\models;

use app\models\Post as PostModel;

class Post extends PostModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            ['status', 'in', 'range' => [self::UNPUBLISHED, self::PUBLISHED, self::TRASH]],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        return $fields;
    }
}