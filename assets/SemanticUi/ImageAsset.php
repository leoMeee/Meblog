<?php
namespace app\assets\SemanticUI;

use yii\web\AssetBundle;

class ImageAsset extends AssetBundle
{
    public $basePath = '@webroot/libs/semantic-ui/components';
    public $baseUrl = '@web/libs/semantic-ui/components';
    public $css = [
        'image.min.css',
        'transition.min.css',
    ];
    public $js = [
        'transition.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}