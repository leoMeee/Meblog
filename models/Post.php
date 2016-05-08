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
    const  UNPUBLISHED = 1; //未发布
    const  PUBLISHED = 2;  //已发布
    const  TRASH = 3;  //回收站

    private $_oldTags;

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
            [['content', 'title'], 'required'],
            ['status', 'in', 'range' => [self::UNPUBLISHED, self::PUBLISHED, self::TRASH]],
            [['title', 'tags'], 'string', 'max' => 255],
            [
                'tags',
                'match',
                'pattern' => '/^[a-zA-Z\s,]+$/',
                'message' => '标签只能是字母+逗号隔开',
            ],
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

    /**
     * 作者
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }


    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->_oldTags = $this->tags;

        parent::afterFind();
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->author_id = Yii::$app->user->id;
        }

        $this->tags = Tag::tag2string(Tag::tag2array($this->tags));

        return parent::beforeSave($insert);
    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        Tag::updateFrequency($this->_oldTags, $this->tags);

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        Tag::removeTags(Tag::tag2array($this->tags));

        parent::afterDelete();
    }
}
