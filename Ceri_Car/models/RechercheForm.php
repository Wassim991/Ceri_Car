<?php

namespace app\models;

use yii\base\Model;

class RechercheForm extends Model
{
    public $Depart;         // Ville de départ
    public $Arrivee;        // Ville d'arrivée
    public $Nbplacedemande; // Nombre de places demandées

    public function rules()
    {
        return [
            [['Depart', 'Arrivee', 'Nbplacedemande'], 'required'],
            [['Depart', 'Arrivee'], 'string', 'max' => 255],
            [['Nbplacedemande'], 'integer', 'min' => 1], // Nbplacedemande doit être un entier positif
        ];
    }


    public function attributeLabels()
    {
        return [
            'Depart' => 'Ville de départ',
            'Arrivee' => 'Ville d\'arrivée',
            'Nbplacedemande' => 'Nombre de places demandée',
        ];
    }




    /*public function rechercherVoyages()
    {
        $voyages = Voyage::getAllVoyages();

        $results = [];
        foreach ($voyages as $voyage) {
            $trajet = $voyage->trajetv; // Utilisation de la relation
            if (
                $trajet &&
                $trajet->depart === $this->Depart &&
                $trajet->arrivee === $this->Arrivee &&
                $voyage->nbplacedispo >= $this->$Nbplacedemande
            ) {

                $results[] = $voyage;
            }
        }

        return $results;
    }*/


}
