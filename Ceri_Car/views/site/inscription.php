<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Inscription';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<div class="site-inscription d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow card-inscription">
        <div class="card-body">
            <div id="notification-banner" class="alert mt-4" style="display: none;"></div>

            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            <p class="text-center">Veuillez remplir les champs suivants pour vous inscrire :</p>

            <?php $form = ActiveForm::begin([
                'id' => 'inscription-form',
                'action' => ['site/inscription'],
                'method' => 'post',
            ]); ?>
            <div class="row">
                <div class="col-md-6 half">
                    <?= $form->field($model, 'pseudo')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'pass')->passwordInput() ?>
                    <?= $form->field($model, 'nom')->textInput() ?>
                    <?= $form->field($model, 'prenom')->textInput() ?>
                </div>
                <div class="col-md-6 half">
                    <?= $form->field($model, 'mail')->input('email') ?>
                    <?= $form->field($model, 'photo')->textInput(['placeholder' => 'Lien de la photo']) ?>
                    <?= $form->field($model, 'permis')->textInput(['placeholder' => 'Numéro de permis de conduire']) ?>
                </div>
            </div>

            <div class="form-group text-center">
                <?= Html::submitbutton('Inscription', ['class' => 'btn btn-primary w-100', 'id' => 'inscription-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

