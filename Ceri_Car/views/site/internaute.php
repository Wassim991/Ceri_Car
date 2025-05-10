<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>

<div class="container mt-4">
    <div id="notification-banner" class="alert mt-4" style="display: none;"></div>

    <h2 class="text-center">Informations de l'internaute</h2>

    <div class="row g-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Vos Détails </h5>
                    <p class="card-text">
                        <strong>Pseudo :</strong> <?= Html::encode($user->pseudo) ?><br>
                        <strong>Nom :</strong> <?= Html::encode($user->nom) ?><br>
                        <strong>Prénom :</strong> <?= Html::encode($user->prenom) ?><br>
                        <strong>Email :</strong> <?= Html::encode($user->mail) ?><br>
                        <img src='<?= Html::encode($user->photo) ?>' alt='Photo de linternaute' class="img-fluid mt-3" style="max-width: 200px;">
                        <?php if ($user->permis !== null): ?>
                            <br><strong>Numéro de Permis :</strong> <?= Html::encode($user->permis) ?><br>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($proposition) && !empty($user->permis)): ?>
        <h3 class="text-center mt-5"> Vos Propositions de Voyages</h3>
        <div class="row g-4">
            <?php foreach ($proposition as $prop): ?>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Voyage proposé</h5>
                            <p class="card-text">
                                <strong>Véhicule :</strong> <?= Html::encode($prop->typevehicule) ?><br>
                                <strong>Places disponibles :</strong> <?= Html::encode($prop->nbplacedispo) ?><br>
                                <strong>Heure de départ :</strong> <?= Html::encode($prop->heuredepart) ?><br>
                                <strong>Tarif :</strong> <?= Html::encode($prop->tarif) ?> €/km<br>
                                <strong>Trajet :</strong> <?= Html::encode($prop->trajetv->depart) ?> -> <?= Html::encode($prop->trajetv->arrivee) ?><br>
                                <strong>Distance :</strong> <?= Html::encode($prop->trajetv->distance) ?> km
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-5">Les Propositions sont vides</div>
    <?php endif; ?>

    <?php if (!empty($reservation)): ?>
        <h3 class="text-center mt-5"> Vos Réservations</h3>
        <div class="row g-4">
            <?php foreach ($reservation as $reserv): ?>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Détails de la réservation</h5>
                            <p class="card-text">
                                <strong>Nom du Conducteur :</strong> <?= Html::encode($reserv->voyagev->conducteurv->pseudo) ?><br>
                                <strong>Type de véhicule :</strong> <?= Html::encode($reserv->voyagev->typevehicule) ?><br>
                                <strong>Nombre de places réservées :</strong> <?= Html::encode($reserv->nbplaceresa) ?><br>
                                <strong>Heure de départ :</strong> <?= Html::encode($reserv->voyagev->heuredepart) ?><br>
                                <strong>Trajet :</strong> <?= Html::encode($reserv->voyagev->trajetv->depart) ?> -> <?= Html::encode($reserv->voyagev->trajetv->arrivee) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-5">Les réservations sont vides</div>
    <?php endif; ?>
</div>
