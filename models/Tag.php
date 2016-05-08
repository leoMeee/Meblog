<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * 字符串tags转数组
     * @param $tags string
     * @return string
     */
    public static function tag2array($tags)
    {
        return array_map(
            function ($tag) {
                return trim($tag);
            },
            array_unique(explode(',', $tags))
        );
    }

    /**
     * 数组tags转字符串
     * @param array $tags
     * @return string
     */
    public static function tag2string(array $tags)
    {
        return implode(',', $tags);
    }

    /**
     * 更新tag使用频率
     * --------------------------
     * 对比 $oldTags 与 $newTags
     * $newTags 中新增的 tags 频率+1
     * 未出现在 $newTags 中的 tags 频率-1
     * --------------------------
     * @param $oldTags
     * @param $newTags
     */
    public static function updateFrequency($oldTags, $newTags)
    {
        $oldTags = self::tag2array($oldTags);
        $newTags = self::tag2array($newTags);
        if (!empty($oldTags) || !empty($newTags)) {
            self::removeTags(array_diff($oldTags, $newTags));
            self::addTags(array_diff($newTags, $oldTags));
        }
    }

    /**
     * 添加标签
     * -------------------
     * 如果标签存在,频率 +1
     * 如果标签不存在,新增标签
     * -------------------
     * @param array $tags
     */
    public static function addTags(array $tags)
    {
        if (empty($tags)) {
            return;
        }
        foreach ($tags as $name) {
            if(empty($name)) continue;
            $tag = Tag::findOne(['name' => $name]);
            if (empty($tag)) {
                $tag = new Tag();
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            } else {
                $tag->frequency += 1;
                $tag->save();
            }
        }

    }

    /**
     * 移除标签
     * ------------------------------------------
     * 如果标签存在并且使用频率 <=1 ,直接删除.否则频率-1
     * ------------------------------------------
     * @param array $tags
     * @return  mixed
     */
    public static function removeTags(array $tags)
    {
        if (empty($tags)) {
            return;
        }
        foreach ($tags as $name) {
            $tag = Tag::findOne(['name' => $name]);
            if (!empty($tag)) {
                if ($tag->frequency <= 1) {
                    return $tag->delete();
                } else {
                    $tag->frequency -= 1;

                    return $tag->save();
                }
            }
        }

    }
}
