<?php

use yii\db\Migration;

class m160401_055421_create_table_post extends Migration
{
    public function up()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull()->defaultValue("")->comment('标题'),
            'content' => $this->text()->notNull()->comment('内容'),
            'tags' => $this->string(255)->defaultValue("")->comment('标签 '),
            'status' => $this->boolean()->notNull()->defaultValue(1)->unsigned()->comment('状态1. 未发布 2. 已发布 3.回收站'),
            'created_at' => $this->integer(10)->notNull()->defaultValue(10)->unsigned(),
            'updated_at' => $this->integer(10)->notNull()->defaultValue(10)->unsigned(),
            'author_id' => $this->integer()->notNull()->defaultValue(0)->unsigned()->comment('作者')
        ]);
    }

    public function down()
    {
        return false;
    }
}
