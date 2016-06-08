<?php
namespace app\modules\frontendApi\controllers;

use yii\rest\Controller;
use Yii;

class NavController extends Controller
{

    public function actionIndex()
    {
        $return = array();
        $return['siteName'] = 'MeBlog';
        $return['menus'] = [
            [
                'name' => '首页',
                'url' => '/',
            ],
            [
                'name' => '归档',
                'url' => '/',
            ],
        ];

        return $return;
    }

}
