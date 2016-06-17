<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var \yii\web\View $this */
/* @var string $content */

AppAsset::register($this);
$this->params['backgroundImage'] = isset($this->params['backgroundImage']) ? $this->params['backgroundImage'] : "/img/about-bg.jpg";

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= Html::csrfMetaTags() ?>
    <title><?= isset($this->title) ? Html::encode($this->title) : Yii::$app->params['website.name'] ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Navigation -->
<?php
NavBar::begin(
    [
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'brandLabel' => Yii::$app->params['website.name'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-custom navbar-fixed-top',
        ],
    ]
);
$menuItems = [
    ['label' => '主页', 'url' => ['/']],
    ['label' => '归档', 'url' => ['/']],
];
echo Nav::widget(
    [
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]
);
NavBar::end();
?>

<!-- Page Header -->
<header class="intro-header" style="background-image: url('<?= $this->params['backgroundImage'] ?>')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php if (isset($this->blocks['heading'])): ?>
                    <?= $this->blocks['heading'] ?>
                <?php else: ?>
                    <div class="site-heading">
                        <div class="ui small sequenced images">
                            <img src="/img/elyse.png" class="ui circular image">
                        </div>
                        <span class="subheading">Fear cuts deeper than swords.</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <?= $content ?>
</div>

<hr>
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p class="copyright text-muted">Copyright &copy;Meblog 2016</p>
                
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
