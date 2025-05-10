<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<div id="notification-banner" class="alert mt-4" style="display: none;"></div>

<div class="site-login d-flex justify-content-center align-items-center" style="min-height: 100vh;">



    <div class="card shadow card-login">
        <div id="ajax-content" class="mt-5"></div>
        <div class="card-body">
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            <p class="text-center">Please fill out the following fields to login:</p>
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'action' => ['site/login'], // URL correcte de l'action login
                'method' => 'post',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'pseudo')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox(['template' => "{input} {label}\n{error}"]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 mb-3', 'id' => 'login-button']) ?>
            </div>



            <div class="text-center">
                <p>Don't have an account? Register below:</p>
                <?= Html::a('Sign Up', ['site/inscription'], ['class' => 'btn btn-success w-100']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
