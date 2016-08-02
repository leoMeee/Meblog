<?php
/*
 * 前台asset
 * @author     wanglei@wyzc.com
 * @created_at    16/6/17 下午9:33
 */
namespace app\assets;

use yii\web\AssetBundle;


class AppAsset extends AssetBundle
{
    public $sourcePath = "@app/static/frontend/dist";

    public $js = [
        'app.bundle.js',
    ];
    
}
