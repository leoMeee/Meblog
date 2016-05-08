<?php

use yii\db\Migration;

class m160401_074645_create_tag extends Migration
{
    public function up()
    {
        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->defaultValue("")->comment('标签名'),
            'frequency' => $this->integer()->notNull()->defaultValue(0)->unsigned()->comment('被引用次数'),
        ]);
    }

    public function down()
    {
        $this->dropTable('tag');
    }
}
