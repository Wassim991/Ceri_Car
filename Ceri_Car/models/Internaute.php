<?php 
namespace app\models;

use yii;
use yii\db\ActiveRecord;


Class Internaute extends ActiveRecord   {
    
    public static function tablename(){
        return 'fredouil.internaute';
    }

    public function addUser($data)
    {
        $this->pseudo = $data['pseudo'];
        $this->pass = sha1($data['pass']); // Hash du mot de passe
        $this->nom = $data['nom'];
        $this->prenom = $data['prenom'];
        $this->mail = $data['mail'];
        $this->photo = $data['photo'];
        $this->permis = $data['permis'];

        return $this->save();
    }


    public static function findIdentity($id)
    {
        return self::findOne($id);
    }
    public static function findByPseudo($pseudo){
        return self::find()->where(['pseudo' => $pseudo])->one();
    }
   
    /*
    public function getPropositions(){
        return $this->hasMany(Voyage::class,['conducteur'=>'id']);
    }
    public function getReservations(){
        return $this->hasMany(Reservation::class, ['voyageur' => 'id']);
    }
    */
}


    



