<?php
namespace app\components;

use yii\rest\Controller;
use yii\filters\auth\QueryParamAuth;

class RestController extends Controller
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => QueryParamAuth::className(),
//            'optional' => $this->optional(),
//        ];

        return $behaviors;
    }

    protected function optional()
    {
        return [];
    }
}