<?php

namespace app\models;

use yii\base\Model;

class ReservationForm extends Model {
    public $Voyage;
    public $VoyageurId;
    public $nbePlaceReserve;

    public function rules()
    {
        return [
            [['Voyage', 'VoyageurId', 'nbePlaceReserve'], 'required'],
            ['nbePlaceReserve', 'integer', 'min' => 1],
            ['nbePlaceReserve', 'validatePlacesAvailable'],
        ];
    }

    public function validatePlacesAvailable($attribute, $params)
    {
        $voyage = Voyage::findOne($this->Voyage);
        if ($voyage && $this->nbePlaceReserve > $voyage->getNbePlacesRestantes()) {
            $this->addError($attribute, 'Le nombre de places demandées dépasse le nombre de places disponibles.');
        }
    }
}