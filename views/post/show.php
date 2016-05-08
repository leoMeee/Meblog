<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\Tag;
use app\widgets\Comment;
use yii\helpers\Markdown;

$this->title = Html::encode($model->title);
$this->params['breadcrumbs'][] = ['label' => '日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?= Html::encode($model->title) ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="pull-right">
                        <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn-sm"><span
                                class="glyphicon glyphicon-edit"></span> 编辑</a>
                        <a href="<?= Url::to(['delete', 'id' => $model->id]) ?>" class="btn-sm"><span
                                class="glyphicon glyphicon-trash"></span> 删除</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <?= Markdown::process($model->content) ?>
            </div>
            <div class="panel-footer">
                <span class="pull-right">更新于 <?= date('m/d H:i:s', $model->updated_at) ?></span>
                <span><span class="glyphicon glyphicon-user"></span> <?= $model->author->username ?></span>
                <?= Tag::widget(['tags' => $model->tags]) ?>
            </div>
        </div>
    </div>
    <?= Comment::widget(['post_id' => $model->id]) ?>
</div>

