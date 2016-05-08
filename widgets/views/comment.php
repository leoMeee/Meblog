<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="col-md-12">
    <?php foreach ($comments as $comment): ?>
        <a name="comment-<?=$comment->id?>"></a>
        <div class="panel panel-default" >
            <div class="panel-heading">
                <span class="glyphicon glyphicon-user"></span>
                <?= $comment->author ?>
                <span class="text-muted pull-right"><?= date('Y-m-d', $comment->created_at) ?></span>
            </div>
            <div class="panel-body">
                <?= Html::encode($comment->content) ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?= LinkPager::widget(['pagination' => $pages]) ?>
    <hr/>
</div>
<div class="col-md-12">
    <?php $form = ActiveForm::begin(
        [
            'id' => 'comment-form',
            'method' => 'post',
            'action' => Url::to('/comment/create'),
        ]
    ) ?>
    <?= Html::activeHiddenInput($model, 'post_id') ?>
    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton('评论', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php $form->end() ?>
</div>





