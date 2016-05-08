<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use app\widgets\NewComment;
use app\widgets\TagCloud;

$this->title = '日志列表';
$this->params['breadcrumbs'][] = $this->title;
?>
    <style>
        .list-group-item {
            height: 50px;
            padding-top: 15px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <?= $this->render('_search') ?>
                </div>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="col-md-4">
                        <?= Html::a('创建日志', ['create'], ['class' => 'pull-right btn btn-success ']) ?>
                    </div>
                <?php endif; ?>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-9">
                    <div class="list-group">
                        <?php foreach ($models as $model): ?>
                            <a class="list-group-item" href="<?= Url::to(['post/show', 'id' => $model->id]) ?>">
                                <?= Html::encode($model->title) ?>
                                <span class="pull-right text-muted"><?= date("Y-m-d", $model->created_at) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <?= TagCloud::widget() ?>
                    <?= NewComment::widget() ?>
                </div>
            </div>
        </div>

    </div>
<?= LinkPager::widget(['pagination' => $pages]) ?>