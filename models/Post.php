<?php

namespace app\models;

use app\models\queries\PostQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $author_id
 */
class Post extends \yii\db\ActiveRecord
{
    const  STATUS_UNPUBLISHED = 1; //未发布
    const  STATUS_PUBLISHED = 2;  //已发布
    const  STATUS_TRASH = 3;  //回收站

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            ['status', 'in', 'range' => [self::STATUS_UNPUBLISHED, self::STATUS_PUBLISHED, self::STATUS_TRASH]],
            [['title', 'tags'], 'string', 'max' => 255],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'author_id' => '作者',
        ];
    }

    public function Behaviors()
    {
        return [
            'timestamp' => ['class' => TimestampBehavior::className()],
        ];
    }

    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
