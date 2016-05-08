<?php
/*
 * 显示标签
 * @author     wanglei@wyzc.com
 * @created_at    16/4/25 下午4:57
 */
namespace app\widgets;

use yii\base\Widget;
use app\models\Tag as TagModel;

class Tag extends Widget
{
    public $tags;
    private $type = ['default', 'primary', 'success', 'info', 'danger', 'warning'];


    public function init()
    {
        parent::init();
        if (!is_array($this->tags)) {
            $this->tags = TagModel::tag2array($this->tags);
        }
        $tag_tmp = $this->tags;
        $this->tags = array();
        foreach ($tag_tmp as $k => $tag) {
            $this->tags[$k]['name'] = $tag;
            $this->tags[$k]['type'] = $this->type[crc32($tag) % count($this->type)];
        }
    }

    public function run()
    {
        return $this->render(
            'tag',
            [
                'tags' => $this->tags,
            ]
        );
    }
}