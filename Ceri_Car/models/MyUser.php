<?php namespace app\models;



use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class MyUser extends ActiveRecord implements IdentityInterface {
    public static function tableName() {
        return 'fredouil.internaute';
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }



    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }


    public function getUsername() {
        return $this->identifiant;
    }


}


?>