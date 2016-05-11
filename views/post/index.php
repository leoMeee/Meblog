<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <?php foreach ($models as $model): ?>
            <div class="post-preview">
                <a href="<?=Url::to(['post/show','id'=>$model->id])?>">
                    <h2 class="post-title">
                        <?= Html::encode($model->title) ?>
                    </h2>
                </a>
                <p class="post-meta">发布于 <?=date('Y-m-d H:i:s',$model->created_at)?></p>
            </div>
            <hr>
        <?php endforeach; ?>
        <?= LinkPager::widget(['pagination' => $pages]) ?>
    </div>
</div>




