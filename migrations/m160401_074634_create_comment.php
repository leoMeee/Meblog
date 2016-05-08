<?php

use yii\db\Migration;

class m160401_074634_create_comment extends Migration
{
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull()->comment('内容'),
            'status' => $this->boolean()->notNull()->unsigned()->defaultValue(1)->comment("状态：1.审核中 2.已通过"),
            'created_at' => $this->integer(10)->notNull()->unsigned()->defaultValue(0),
            'author' => $this->string()->notNull()->defaultValue("")->comment('评论者'),
            'email' => $this->string()->defaultValue("")->comment('邮箱'),
            'url' => $this->string()->defaultValue("")->comment('url'),
            'post_id' => $this->integer()->notNull()->unsigned()->defaultValue(0)->comment('日志id'),
        ]);
    }

    public function down()
    {
        return false;
    }
}
