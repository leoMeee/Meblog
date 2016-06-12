<?php
namespace app\modules\frontendApi\controllers;

use yii\rest\Controller;
use Yii;

class BannerController extends Controller
{

    public function actionIndex()
    {
        $return = [
            'img' => '/img/about-bg.jpg',
            'user' => [
                'name' => 'leo',
                'avatar' => '/img/elyse.png',
                'say' => 'Winner is Coming',
            ],
        ];

        return $return;
    }

}
