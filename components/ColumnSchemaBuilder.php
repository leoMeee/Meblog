<?php
namespace app\components;

class ColumnSchemaBuilder extends \yii\db\ColumnSchemaBuilder
{
    protected $comment;

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return
            $this->type .
            $this->buildLengthString() .
            $this->buildUnsignedString() .
            $this->buildNotNullString() .
            $this->buildUniqueString() .
            $this->buildDefaultString() .
            $this->buildCheckString() .
            $this->buildCommentString();
    }

    public function buildCommentString()
    {
        return $this->comment ? " COMMENT '{$this->comment}'" : '';
    }

    public function comment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}