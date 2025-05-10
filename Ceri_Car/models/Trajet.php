<?php namespace app\models;


use yii\db\ActiveRecord;
use app\models\Voyage;
Class Trajet extends ActiveRecord {
    public static function tableName(){
        return 'fredouil.trajet';
    }
    public static function findTrajetById($trajetId){
        return self::findOne($trajetId);
    }

    public static function getTrajet($VilleDepart, $VilleArrive)
    {
        return self::findOne(['depart' => $VilleDepart, 'arrivee' => $VilleArrive]);
    }



}