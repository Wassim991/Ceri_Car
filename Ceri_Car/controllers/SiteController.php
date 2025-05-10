<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web;
use yii\filters\VerbFilter;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Internaute;
use app\models\RechercheForm;
use app\models\Voyage;
use app\models\Trajet;
use app\models\InscriptionForm;
use app\models\ReservationForm;
use app\models\Reservation;
use app\models\PropositionForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string[]
     */
    public function actionLogin()
    {
        // Ici on va forcer le format de la réponse en fonction si c'est une requete AJAX ou pas
        Yii::$app->response->format = Yii::$app->request->isAjax ? Response::FORMAT_JSON : Response::FORMAT_HTML;

        // Vérifie si l'utilisateur est déjà connecté pour éviter de lui reproposer le formulaire
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->isAjax) {
                // Si c'est une requête AJAX, on renvoi un message disant qu'il est déjà connecté
                return [
                    'html' => $this->renderPartial('_welcome', ['user' => Yii::$app->user]),
                    'type' => 'info',
                    'message' => 'Vous êtes déjà connecté.'
                ];
            }
        }

        // On instancie le modèle LoginForm qui va gérer les données de connexion
        $model = new LoginForm();

        // Si le formulaire est soumis avec des données valides
        if ($model->load(Yii::$app->request->post())) {
            // On vérifie si les identifiants sont corrects
            if ($model->login()) {
                // Si c'est une requête AJAX et que la connexion est réussie
                if (Yii::$app->request->isAjax) {
                    return [

                        'type' => 'success', // Indique que l'opération a réussi
                        'message' => 'Connexion réussie !',
                        'redirect' => Yii::$app->urlManager->createUrl(['site/index']) // Redirection vers l'accueil
                    ];
                }
            } else {
                // Si la connexion échoue, on envoie un message d'erreur en AJAX
                if (Yii::$app->request->isAjax) {
                    return [
                        'type' => 'danger', // Indique une erreur (pseudo ou mot de passe incorrect)
                        'message' => 'Pseudo ou mot de passe incorrect.',
                    ];
                }
            }
        }

        // Réinitialisation du champ mot de passe pour ne pas le laisser affiché en cas d'erreur
        $model->password = '';
        // Si aucune requête AJAX ou échec de validation, on affiche le formulaire de login classique
        return $this->render('login', [
            'model' => $model,
        ]);
    }













    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {

        // Vérifie si la requête est de type POST (la déconnexion doit se faire uniquement via une requête POST)
        if (Yii::$app->request->isPost) {
            // Déconnecte l'utilisateur
            Yii::$app->user->logout();

            // Si c'est une requête AJAX, on retourne une réponse en format JSON
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'type' => 'success', // Indique que l'opération a réussi
                    'message' => 'Déconnexion réussie.', // Message à afficher à l'utilisateur
                    'redirect' => Yii::$app->urlManager->createUrl(['site/index']) // Redirige vers la page d'accueil
                ];
            }

            // Si ce n'est pas une requête AJAX, on redirige l'utilisateur vers la page d'accueil
            return $this->goHome();
        }


        // Redirige l’utilisateur vers la page d’accueil (cas où une mauvaise méthode est utilisée)
        return $this->goHome();
    }











    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    //function pour la page MapageForm
    public function actionMapage(){
        $model= new MaPageForm();
        return $this->render('mapage',[
            'model'=>$model,
        ]);
    }

   
    public function actionInternaute(){
        $user = Yii::$app->user->identity;
    //$internaute = Internaute::findByPseudo($pseudo);
    if($user !==null){

        
    
    $proposition = $user->propositions;
    $reservation = $user->reservations;
    
    return $this->render('internaute', [
        'user' => $user,
        'proposition' => $proposition,
        'reservation' => $reservation,
    ]);
    }
    else{
        echo "pseudo non correcte ou utilisateur n'existe pas";
    }
}

    public function actionRecherche()
    {
        $model = new RechercheForm();
        $results = [];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Récupérer le trajet correspondant

            $trajet = Trajet::getTrajet(ucfirst(strtolower($model->Depart)), ucfirst(strtolower($model->Arrivee)));

            if ($trajet) {
                // Récupérer les voyages correspondant au trajet
                $voyages = Voyage::getVoyagesByTrajet($trajet->id);

                foreach($voyages as $voyage){
                    $nbePlacesRestantes = intval($voyage->getNbePlacesRestantes());
                    if ($model->Nbplacedemande > $nbePlacesRestantes ) {
                            continue;

                         } else {
                            array_push($results, $voyage);
                    }
                }
            }
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'html' => $this->renderPartial('_results', ['results' => $results]),
                'message' => count($results) > 0 ? 'Voyages trouvés.' : 'Aucun voyage correspondant.',
                'type' => count($results) > 0 ? 'success' : 'danger',
            ];
        }

        return $this->render('recherche', [
            'model' => $model,
            'results' => $results,
        ]);
    }

    public function actionInscription()
    {
        $model = new InscriptionForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $internaut = new Internaute();

            if ($internaut->addUser($model->attributes)) {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'type' => 'success',
                        'message' => 'Inscription réussie ! Vous pouvez maintenant vous connecter.',
                        'redirect' => Yii::$app->urlManager->createUrl(['site/login']) // URL de redirection après inscription
                    ];
                }

                //return $this->redirect(['login']); // Redirection classique
            } else {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'type' => 'danger',
                        'message' => '
                        Veuillez corriger les erreurs dans le formulaire',
                    ];
                }

            }
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'type' => 'danger',
                'message' => 'Erreur lors de linscription.',
            ];
        }

        return $this->render('inscription', [
            'model' => $model,
        ]);
    }




    public function actionReservation($voyageId)
    {
        //findone du voyage
        $voyage = Voyage::FindVoyage($voyageId);

        if (!$voyage) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'type' => 'danger',
                    'message' => 'Voyage introuvable.',
                ];
            }
            return $this->redirect(['site/recherche']);
        }

        if (Yii::$app->user->isGuest) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'type' => 'danger',
                    'message' => 'Veuillez vous connecter pour effectuer une réservation.',
                    'redirect' => Yii::$app->urlManager->createUrl(['site/login']),
                ];
            }
        }

        $model = new ReservationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $reservation = new Reservation();
            if ($reservation->addReservation($model->attributes)) {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'type' => 'success',
                        'message' => 'Réservation réussie.',
                        'redirect' => Yii::$app->urlManager->createUrl(['site/internaute', 'pseudo' => Yii::$app->user->identity->pseudo]),
                    ];
                }

                return $this->redirect(['site/internaute', 'pseudo' => Yii::$app->user->identity->pseudo]);
            } else {
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return [
                        'type' => 'danger',
                        'message' => 'Une erreur est survenue lors de la réservation.',
                    ];
                }

            }
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'html' => $this->renderPartial('reservation', [
                    'model' => $model,
                    'voyage' => $voyage,
                ]),
            ];
        }

        return $this->render('reservation', [
            'model' => $model,
            'voyage' => $voyage,
        ]);
    }



    public function actionProposervoyage()
    {
        $model = new PropositionForm();
        if(Yii::$app->user->isGuest){
            if (Yii::$app->request->isAjax) {
                return $this->asJson([
                    'type' => 'danger',
                    'message' => 'Vous devez etre Connecté pour proposer un voyage.'
                ]);
            }
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate() && !Yii::$app->user->isGuest) {
            $user = Yii::$app->user->identity;

            // Vérification du permis de l'utilisateur
            if (empty($user->permis)) {
                return $this->asJson([
                    'type' => 'danger',
                    'message' => 'Vous devez avoir un permis pour proposer un voyage.'
                ]);
            }

            // Récupération du trajet
            $Trajet = Trajet::getTrajet(ucfirst(strtolower($model->villeDepart)), ucfirst(strtolower($model->villeArrivee)));

            if (!$Trajet) {
                return $this->asJson([
                    'type' => 'danger',
                    'message' => 'Aucun trajet correspondant n’a été trouvé.'
                ]);
            }

            // Création et sauvegarde du voyage
            $voyage = new Voyage();


            if ($voyage->createVoyage($user->id, $Trajet->id, $model->attributes)) {
                return $this->asJson([
                    'type' => 'success',
                    'message' => 'Le voyage a été proposé avec succès.',
                    'redirect' => Yii::$app->urlManager->createUrl(['site/index']) // URL de redirection
                ]);
            } else {
                return $this->asJson([
                    'type' => 'error',
                    'message' => 'Veuillez Remplire le formulaire correctement.'
                ]);
            }
        }

        // Si la requête n'est pas AJAX ou si le formulaire n'est pas soumis, afficher la vue classique
        return $this->render('proposervoyage', ['model' => $model]);
    }












}
