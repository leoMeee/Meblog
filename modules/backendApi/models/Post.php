<?php
namespace app\modules\backendApi\models;

use app\models\Post as PostModel;

class Post extends PostModel
{
    public function fields()
    {
        $fields = parent::fields();
        
        return $fields;
    }
}