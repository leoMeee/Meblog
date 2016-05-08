<?php
namespace app\components;

use yii\db\mysql\Schema;

class MysqlSchema extends Schema
{
    /**
     * @inheritdoc
     */
    public function createColumnSchemaBuilder($type, $length = null)
    {
        return new ColumnSchemaBuilder($type, $length);
    }
}