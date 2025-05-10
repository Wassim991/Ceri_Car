<?php

namespace app\models;
use yii\db\ActiveRecord;

class User extends MyUser implements \yii\web\IdentityInterface
{
    /*public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
*/

    /**
     * {@inheritdoc}
     */

    /*public static function tableName() {
        return 'fredouil.internaute';
    }*/

    public static function findIdentity($id){
    
        return self::findOne($id);//find user by identifiant
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByIdentifiant($id){
    // Recherche par 'identifiant' qui est le champ de login
        return self::find()->where(['id' => $id])->one();
    }

    public static function findByUsername($pseudo)
    {
        return self::findOne(['pseudo' => $pseudo]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // Générer le hash SHA-1 du mot de passe saisi et le comparer
        return sha1($password) === $this->pass;
    }

    public function getPropositions(){
        return $this->hasMany(Voyage::class,['conducteur'=>'id']);
    }
    public function getReservations(){
        return $this->hasMany(Reservation::class, ['voyageur' => 'id']);
    }

}
