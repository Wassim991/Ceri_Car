<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->registerJsFile(Url::to('@web/js/Site.js'), ['depends' => [\yii\web\JqueryAsset::class]]);

$this->title = 'Rechercher un voyage';
?>

<div id="notification-banner" class="alert mt-4"></div>
<div class="container mt-4">
    <h1 class="text-center h1"><?= Html::encode($this->title) ?></h1>

    <div class="card shadow mt-4">
        <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'recherche-form', 'action' => ['site/recherche'], 'method' => 'post']); ?>

            <div class="row g-3">
                <div class="col-md-4">
                    <?= $form->field($model, 'Depart')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'Arrivee')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'Nbplacedemande')->textInput(['type' => 'number', 'min' => 1, 'class' => 'form-control']) ?>
                </div>
            </div>

            <div class="text-center mt-4">
                <?= Html::button('Rechercher', ['class' => 'btn btn-primary btn-lg', 'id' => 'btnrecherche']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div id="results-container" class="mt-5"></div>
</div>
