<?php
use yii\helpers\Html;

?>
<form class="form-inline" method="get">
    <div class="form-group">
        <?= Html::textInput(
            'title',
            Yii::$app->request->get('title'),
            ['class' => 'form-control', 'placeholder' => '输入日志标题','style'=>'width:300px']
        ) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
    </div>
</form>

