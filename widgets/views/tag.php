<?php
use yii\helpers\Url;

?>
<?php foreach ($tags as $tag): ?>
    <a style="display: inline-block" href="<?= Url::to(['/post/index', 'tag' => $tag['name']]) ?>"
       class="label label-<?= $tag['type'] ?>">
        <?= $tag['name'] ?>
    </a>
<?php endforeach; ?>
