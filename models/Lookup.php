<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup".
 *
 * @property integer $id
 * @property string $name
 * @property integer $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends \yii\db\ActiveRecord
{

    private static $items = array();

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup';
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        return false;
    }

    /**
     * 查找指定类型下的所有items
     * @param $type
     * @return static[]
     */
    public static function items($type)
    {
        if (!isset(self::$items[$type])) {
            self::loadItems($type);
        }

        return self::$items[$type];
    }

    /**
     * 根据类型与code查找item
     * @param $type
     * @param $code
     * @return null|static
     */
    public static function item($type, $code)
    {
        if (!isset(self::$items[$type])) {
            self::loadItems($type);
        }

        return isset(self::$items[$type][$code]) ? self::$items[$type][$code] : false;
    }

    private static function loadItems($type)
    {
        self::$items[$type] = array();
        $items = self::find()->where(compact('type'))->orderBy(['position' => SORT_DESC])->all();
        foreach ($items as $item) {
            self::$items[$type][$item['code']] = $item['name'];
        }
    }
}
