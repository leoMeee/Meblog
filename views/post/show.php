<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
use app\assets\MarkDownAsset;

$this->title = Html::encode($model->title);
$this->params['subTitle'] = $this->title;
$this->params['backgroundImage'] = "/img/post-bg.jpg";
MarkDownAsset::register($this);
$this->registerJs("hljs.initHighlightingOnLoad();")
?>

<?php $this->beginBlock('heading'); ?>
<div class="post-heading">
    <h2 class="subheading"><?= $model->title ?></h2>
    <span class="meta">更新于 <?= date('Y年m月d日 H:i:s', $model->updated_at) ?></span>
</div>
<?php $this->endBlock(); ?>

<article class="markdown-body">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= Markdown::process($model->content) ?>
                </div>
            </div>
        </div>
    </div>
</article>


