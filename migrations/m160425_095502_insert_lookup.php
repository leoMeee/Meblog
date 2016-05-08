<?php

use yii\db\Migration;

class m160425_095502_insert_lookup extends Migration
{
    public function up()
    {
        $this->batchInsert('lookup', ['type', 'name', 'code'], [
            ['PostStatus','未发布',1],
            ['PostStatus','已发布',2],
            ['PostStatus','回收站',3]
        ]);

    }

    public function down()
    {
        echo "m160425_095502_insert_lookup cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
