<?php

namespace app\models;

use Yii;
use app\models\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'author', 'post_id'], 'required'],
            ['author', 'string', 'max' => 128],
            ['post_id', 'integer'],
            [
                'post_id',
                'exist',
                'targetClass' => Post::className(),
                'targetAttribute' => 'id',
                'filter' => ['status' => Post::PUBLISHED],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'author' => '用户名',
            'post_id' => '日志id',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = time();
        }

        return parent::beforeSave($insert);
    }
}
