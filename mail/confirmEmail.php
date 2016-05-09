<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\User $user
 */

$confirmationLink = Yii::$app->urlManager->createAbsoluteUrl(['user/confirm-email', 'token' => $user->email_confirmation_token]);
?>

Hello <?= Html::encode($user->username) ?>,

Follow the link below to complete your registration:

<?= Html::a(Html::encode($confirmationLink), $confirmationLink) ?>
