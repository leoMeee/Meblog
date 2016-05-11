<?php
/*
 * 渲染 markdown 文档
 * @author     wanglei@wyzc.com
 * @created_at    16/5/11 下午4:12
 */
namespace app\assets;

use yii\web\AssetBundle;

class MarkDownAsset extends AssetBundle
{
    public $basePath = '@webroot/libs/markdown';
    public $baseUrl = '@web/libs/markdown';
    public $css = [
        'github-markdown.css',
        'highlight.css',
    ];
    public $js = [
        'highlight.pack.js',
    ];

}
