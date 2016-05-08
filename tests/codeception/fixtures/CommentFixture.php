<?php
namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

class CommentFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Comment';


    public function unload()
    {
        $this->resetTable();
    }
}
