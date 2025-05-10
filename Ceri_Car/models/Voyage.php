<?php namespace app\models;

use yii\db\ActiveRecord;

use app\models\Trajet;

class Voyage extends ActiveRecord {
    
    public static function tablename(){
        return 'fredouil.voyage';
    }


    public static function getAllVoyages()
    {
        return self::find()->with('trajetv')->all(); // Charge les relations pour optimiser
    }

    public function getConducteurv(){
        return $this->hasOne(Internaute::class,['id'=>'conducteur']);
    }
    public function  getTrajetv(){
        return $this->hasOne(Trajet::class,['id'=>'trajet']);
    }
    public static function getVoyagesByTrajet($idTrajet){
        return self::find()
            ->where(['trajet' => $idTrajet])
            ->all();
        }


    public static function FindVoyage($id){
        return self::findOne($id);
    }
    public function getTrajet($villeDepart, $villeArrivee)
    {
        return self::find()
            ->where(['depart' => $villeDepart, 'arrivee' => $villeArrivee])
            ->all();
    }

    public function getNbePlacesRestantes()
    {
        // Calculer la somme des places réservées pour ce voyage
        $nbePlacesTotalesReservees = Reservation::find()
            ->where(['voyage' => $this->id])
            ->sum('nbplaceresa');

        // Calculer les places restantes
        $nbePlacesRestantes = $this->nbplacedispo - $nbePlacesTotalesReservees;

        return $nbePlacesRestantes;
    }

    public function createVoyage($userId, $trajetId, $data)
    {
        // Affecter les valeurs aux attributs de l'instance actuelle
        $this->conducteur = $userId;
        $this->trajet = $trajetId;
        $this->typevehicule = $data['typevehicule'];
        $this->marque = $data['marque'];
        $this->tarif = $data['tarif'];
        $this->nbplacedispo = $data['nbplacedispo'];
        $this->nbbagage = $data['nbbagage'];
        $this->heuredepart = $data['heuredepart'];
        $this->contraintes = $data['contraintes'];

        // Sauvegarder l'instance et retourner le résultat
        return $this->save();
    }


}