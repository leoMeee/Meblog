<?php
namespace app\assets;

use yii\bootstrap\BootstrapAsset as YiiBootstrapAsset;

class BootstrapAsset extends YiiBootstrapAsset
{
    public $js = [
        'js/bootstrap.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}

