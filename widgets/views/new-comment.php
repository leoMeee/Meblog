<?php
use yii\helpers\Url;
use app\helpers\StringHelper;
?>
<?php if (!empty($comments)): ?>
    <div class="panel panel-default">
        <div class="panel-heading">最新评论</div>
        <div class="list-group">
            <?php foreach ($comments as $comment): ?>
                <a href="<?= Url::to(['/post/show', 'id' => $comment->post_id,'#'=>'comment-'.$comment->id]) ?>"
                   class="list-group-item"><?= StringHelper::truncate_utf8_string($comment->content,15) ?></a>
            <?php endforeach; ?>
        </div>
    </div>

<?php endif; ?>






