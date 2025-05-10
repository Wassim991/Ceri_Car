<?php

/** @var yii\web\View $this */

$this->title = 'Application de Voyage - Voyager Ensemble';
$this->registerJsFile('@web/js/Site.js', ['depends' => [\yii\web\JqueryAsset::class]]);

?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<div id="notification-banner" class="alert" style="display: none;"></div>
<div class="site-index" id="index">
    <div class="jumbotron text-center" style="
        background-image: url('https://www.sncf-connect.com/assets/styles/ratio_4_1_max_width_1920/public/media/2023-12/istock-501457846.jpg?h=c246c344&itok=N4nHNduS');
        background-size: cover;
        background-position: center;
        color: #ffffff; /* Texte en blanc pour contraster avec l'image */
        padding: 100px 20px;
        border-radius: 15px;
    ">
        <h1 class="display-4">Voyagez Ensemble, Partagez des Moments !</h1>
        <p class="lead">Trouvez ou proposez des voyages à partager avec d’autres voyageurs. Économisez, rencontrez et explorez !</p>
        <p><a class="btn btn-primary btn-lg" href="<?= \yii\helpers\Url::to(['site/recherche']) ?>">Rechercher un Voyage</a></p>
    </div>
</div>


    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h2>Pourquoi choisir notre plateforme ?</h2>
                <p>Notre application vous permet de trouver rapidement des voyages partagés adaptés à vos besoins. Que vous souhaitiez voyager seul ou avec des amis, nous avons toujours une solution pour vous !</p>
                <p>Économisez sur vos trajets, réduisez votre empreinte carbone et profitez d’une expérience conviviale avec d’autres voyageurs.</p>
                <p><a class="btn btn-success" href="<?= \yii\helpers\Url::to(['site/proposervoyage']) ?>">Proposer un Voyage</a></p>
            </div>
            <div class="col-lg-6">
                <img src="https://img.freepik.com/photos-gratuite/atmosphere-reve-scene-couleurs-pastel-pour-contenu-voyage_23-2151450565.jpg" alt="Voyage en voiture" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</div>
