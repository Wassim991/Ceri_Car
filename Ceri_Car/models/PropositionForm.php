<?php

namespace app\models;

use Yii;
use yii\base\Model;

class PropositionForm extends Model
{
    public $conducteur;
    public $trajet;
    public $typevehicule;
    public $marque;
    public $tarif;
    public $nbplacedispo;
    public $nbbagage;
    public $heuredepart;
    public $contraintes;
    public $villeDepart;
    public $villeArrivee;

    /**
     * Règles de validation
     */
    public function rules()
    {
        return [
            [['villeDepart', 'villeArrivee', 'typevehicule', 'marque', 'tarif', 'nbplacedispo', 'nbbagage', 'heuredepart'], 'required'],
            [['tarif'], 'number'],
            [['nbplacedispo', 'nbbagage'], 'integer'],
            [['heuredepart'], 'integer'],
            [['contraintes'], 'string'],
        ];
    }

    /**
     * Labels des champs
     */
    public function attributeLabels()
    {
        return [
            'villeDepart' => 'Ville de départ',
            'villeArrivee' => 'Ville d’arrivée',
            'typevehicule' => 'Type de véhicule',
            'marque' => 'Marque',
            'tarif' => 'Tarif (€/km)',
            'nbplacedispo' => 'Nombre de places disponibles',
            'nbbagage' => 'Nombre de bagages autorisés',
            'heuredepart' => 'Heure de départ',
            'contraintes' => 'Contraintes (animaux, non-fumeur, etc.)',
        ];
    }
}
