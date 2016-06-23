<?php
/*
 * 后台asset
 * @author     wanglei@wyzc.com
 * @created_at    16/6/17 下午9:33
 */
namespace app\assets;

use yii\web\AssetBundle;


class BackendAsset extends AssetBundle
{
    public $sourcePath = "@app/static/backend/dist";

    public $js = [
        'app.bundle.js',
    ];

}
