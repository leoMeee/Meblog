<?php
/*
 * 标签云
 * @author     wanglei@wyzc.com
 * @created_at    16/4/27 上午11:45
 */
namespace app\widgets;

use yii\base\Widget;
use app\models\Tag as TagModel;
use app\assets\TagCloudWidgetAsset;

class TagCloud extends Widget
{
    private $tags;
    private $count = 20;

    public function init()
    {
        parent::init();
        $this->tags = TagModel::find()->orderBy(['frequency' => SORT_DESC])->limit($this->count)->all();
    }

    public function run()
    {
        TagCloudWidgetAsset::register($this->view);

        return $this->render(
            'tag-cloud',
            [
                'tags' => is_array($this->tags) ? $this->tags : array(),
            ]
        );
    }
}