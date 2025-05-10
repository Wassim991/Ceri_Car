<?php
namespace  app\models;

use yii\base\Model;


class InscriptionForm extends Model{

    public $pseudo;
    public $pass;
    public $nom;
    public $prenom;
    public $mail;
    public $photo;
    public $permis;

    public function rules()
    {
        return [
            [['pseudo', 'pass', 'nom', 'prenom', 'mail', 'photo'], 'required'],
            ['pseudo', 'string', 'max' => 50],
            ['pass', 'string', 'max' => 255],
            ['nom', 'string', 'max' => 100],
            ['prenom', 'string', 'max' => 100],
            ['mail', 'email'],
            ['mail', 'string', 'max' => 150],
            ['photo', 'string', 'max' => 255],
            ['permis', 'string', 'max' => 50],
        ];
    }
    public function attributeLabels(){
        return [
            'pseudo' => 'Pseudo',
            'pass' => 'Password',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'mail' => 'EMAIL',
            'photo' => 'Photo',
            'permis'=>'Numero de Permis Conduire',
        ];
    }
}


