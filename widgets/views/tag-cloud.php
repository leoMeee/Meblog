<?php
use yii\helpers\Url;

?>
<?php if (!empty($tags)): ?>
    <div class="panel panel-default tag-cloud">
        <div class="panel-heading">标签</div>
        <div class="panel-body">
            <?php foreach ($tags as $tag): ?>
                <?php $type = $tag->name == \Yii::$app->request->get('tag') ? "success" : "primary" ?>
                <a href="<?= Url::to(['/post/index', 'tag' => $tag['name']]) ?>" style="display: inline-block" class="label label-<?=$type?>">
                    <?= $tag->name ?>
                    <span class="badge"><?=$tag->frequency?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>