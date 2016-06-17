<?php

$this->title = "创建日志";
$this->params['breadcrumbs'][] = ['label' => '日志列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-8 ">
        <?= $this->render('_form', compact('model')) ?>
    </div>
</div>
