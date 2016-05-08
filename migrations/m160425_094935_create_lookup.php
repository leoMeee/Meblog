<?php

use yii\db\Migration;

class m160425_094935_create_lookup extends Migration
{
    public function up()
    {
        $this->createTable(
            'lookup',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull()->defaultValue("")->comment('字符串值，如："已发布"'),
                'code' => $this->integer()->notNull()->defaultValue(0)->unsigned()->comment('数字码 如：1'),
                'type' => $this->string()->notNull()->defaultValue("")->comment('类型，如：PostStatus'),
                'position' => $this->integer()->notNull()->defaultValue(0)->comment('排序值'),
            ]
        );
    }

    public function down()
    {
        return false;
    }
}
