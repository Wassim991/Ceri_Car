<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Réservation';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<div class="site-reservation d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow card-reservation">
        <div class="card-body">

            <div id="notification-banner" class="alert mt-4" style="display: none;"></div>
            <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

            <p class="text-center">Confirmez votre réservation pour le voyage suivant :</p>

            <div class="mb-4">
                <strong>Départ :</strong> <?= Html::encode($voyage->trajetv->depart) ?><br>
                <strong>Arrivée :</strong> <?= Html::encode($voyage->trajetv->arrivee) ?><br>
                <strong>Conducteur :</strong> <?= Html::encode($voyage->conducteurv->pseudo) ?><br>
                <strong>Places restantes :</strong> <?= Html::encode($voyage->getNbePlacesRestantes()) ?><br>
                <strong>Tarif par Place :</strong> <?= Html::encode($voyage->tarif) ?> €
            </div>

            <?php $form = ActiveForm::begin(['id' => 'reservation-form']); ?>
            <?= $form->field($model, 'nbePlaceReserve')->input('number', ['min' => 1, 'max' => $voyage->getNbePlacesRestantes()]) ?>
            <?= $form->field($model, 'Voyage')->hiddenInput(['value' => $voyage->id])->label(false) ?>
            <?= $form->field($model, 'VoyageurId')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
            <div class="form-group text-center">
                <?= Html::submitButton('Confirmer la réservation', ['class' => 'btn btn-success' ,'id'=>'Confirm-Reservation'] ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
