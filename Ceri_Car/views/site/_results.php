<?php
use yii\helpers\Html;
use yii\helpers\Url;

if (!empty($results)): ?>
    <div class="row g-4">
        <?php foreach ($results as $voyage): ?>
            <?php if ($voyage && $voyage->trajetv): ?>
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5>
                                Voyage de <?= Html::encode($voyage->trajetv->depart) ?> à <?= Html::encode($voyage->trajetv->arrivee) ?>
                            </h5>
                            <p class="card-text">
                                <strong>Conducteur :</strong> <?= Html::encode($voyage->conducteurv->pseudo) ?><br>
                                <strong>Type de véhicule :</strong> <?= Html::encode($voyage->typevehicule) ?><br>
                                <strong>Distance :</strong> <?= Html::encode($voyage->trajetv->distance) ?> km<br>
                                <strong>Places restantes :</strong> <?= Html::encode($voyage->getNbePlacesRestantes()) ?><br>
                                <strong>Contraintes : </strong><?= Html::encode($voyage->contraintes) ?><br>
                                <strong>Tarif par Place :</strong> <?= Html::encode($voyage->tarif) ?> €
                            </p>

                            <?php if (Yii::$app->user->id == $voyage->conducteurv->id): ?>
                                <!-- Bouton rouge "Indisponible" si l'utilisateur est le conducteur -->
                                <button class="btn btn-danger" disabled>Indisponible</button>
                            <?php else: ?>
                                <!-- Bouton bleu "Réserver" si l'utilisateur n'est pas le conducteur -->
                                <?= Html::a('Réserver',
                                    Url::to(['site/reservation', 'voyageId' => $voyage->id]),
                                    ['class' => 'btn btn-primary']
                                ) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-danger">Données invalides pour ce voyage.</div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
