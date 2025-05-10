<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Recherche de Voyage';
?>
<div class="container my-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Formulaire de Recherche -->
    <?php $form = ActiveForm::begin([
        'id' => 'recherche-voyage-form',
        'method' => 'get',
        'action' => ['site/recherchervoyage'], // Action à appeler
        'options' => ['class' => 'row g-3']
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'depart')->textInput([
            'class' => 'form-control',
            'placeholder' => 'Départ',
            'required' => true
        ])->label(false) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'destination')->textInput([
            'class' => 'form-control',
            'placeholder' => 'Destination',
            'required' => true
        ])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'date')->input('date', [
            'class' => 'form-control',
            'value' => date('Y-m-d')
        ])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'passagers')->dropDownList([
            '1' => '1 passager',
            '2' => '2 passagers',
            '3' => '3 passagers',
        ], ['class' => 'form-select'])->label(false) ?>
    </div>
    <div class="col-md-2">
        <?= Html::submitButton('Rechercher', ['class' => 'btn btn-primary w-100']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Résultats -->
<?php if (isset($voyages) && !empty($voyages)): ?>
    <div class="container my-4">
        <h2>Résultats de la Recherche :</h2>
        <ul class="list-group">
            <?php foreach ($voyages as $voyage): ?>
                <li class="list-group-item">
                    <p><strong>Départ :</strong> <?= Html::encode($voyage->trajetv->depart) ?></p>
                    <p><strong>Arrivée :</strong> <?= Html::encode($voyage->trajetv->arrivee) ?></p>
                    <p><strong>Places disponibles :</strong> <?= Html::encode($voyage->nbplacedispo) ?></p>
                    <p><strong>Tarif :</strong> <?= Html::encode($voyage->tarif) ?> €/km</p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php elseif (Yii::$app->request->isGet): ?>
    <div class="container my-4">
        <p>Aucun voyage ne correspond à vos critères.</p>
    </div>
<?php endif; ?>
