<?php
namespace tests\codeception\fixtures;

use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Post';


    public function unload()
    {
        $this->resetTable();
    }
}
