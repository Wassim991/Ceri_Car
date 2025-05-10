<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\web\View;


AppAsset::register($this);



//$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\YiiAsset::class]]);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title>The Ceri Car</title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'The Ceri Car',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'custom-navbar navbar-brand custom-navbar navbar-nav nav-link nav-link:hover']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => array_filter([
            ['label' => 'Home', 'url' => ['/site/index']],
            !Yii::$app->user->isGuest ? ['label' => 'Proposer Un Voyage', 'url' => ['/site/proposervoyage']]:null,
            ['label' => 'Rechercher Un Voyage', 'url' => ['/site/recherche']],

            // Afficher "Mon Profile" uniquement si l'utilisateur est connecté
            !Yii::$app->user->isGuest ? ['label' => 'Mon Profile', 'url' => ['/site/internaute']] : null,

            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->pseudo . ')',
                    ['class' => 'nav-link btn btn-link', 'id' => 'logout-button']
                )
                . Html::endForm()
                . '</li>'
        ])
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>


    </div>
    <div id="notification-banner" class="alert" style="display: none;">

        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
