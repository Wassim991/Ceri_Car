<?php
namespace app\models;

use yii\db\ActiveRecord;

Class Reservation extends ActiveRecord{
    public static function tablename(){
        return 'fredouil.reservation';
    }

    public function getVoyageurv(){
        return $this->hasOne(Internaute::class, ['id' => 'voyageur']);
    }
    public function getVoyagev(){
        return $this->hasOne(Voyage::class, ['id' => 'voyage']);
    }
    public function addReservation($data){
        $this->voyage = $data['Voyage'];
        $this->voyageur = $data['VoyageurId'];
        $this->nbplaceresa = $data['nbePlaceReserve'];
        return $this->save();
    }
    public static function getPlacesTotalesReservee($idVoyage)
    {
        $reservations = Reservation::find()->where(['voyage' => $idVoyage])->all();
        $nbePlacesTotalesReserve =0;

        foreach ($reservations as $reservation) {
            $nbePlacesTotalesReserve += $reservation->nbplaceresa;
        }

        return $nbePlacesTotalesReserve;
    }


}