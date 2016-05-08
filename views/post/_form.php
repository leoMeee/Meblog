<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Lookup;

?>

<?php $form = ActiveForm::begin() ?>

<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'content')->textarea(['rows' => 10]) ?>
<?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'status')->dropDownList(Lookup::items('PostStatus')) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => 'btn btn-success btn-sm']) ?>
</div>

<?php ActiveForm::end() ?>
