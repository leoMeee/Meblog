<?php
namespace app\assets;

use yii\web\AssetBundle;

class TagCloudWidgetAsset extends AssetBundle
{
    public $sourcePath = "@app/widgets/assets";

    public $css = [
        'css/tag-cloud.css',
    ];
    
}