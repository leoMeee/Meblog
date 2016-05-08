<?php
namespace app\assets;

use yii\web\AssetBundle;

class CommentWidgetAsset extends AssetBundle
{
    public $sourcePath = "@app/widgets/assets";

    public $js = [
        'js/comment.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}