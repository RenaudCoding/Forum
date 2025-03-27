<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    public function findUserByNickname($nickname) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t
                WHERE t.nickname LIKE :nickname";
       
        // la requête renvoie un enregistrement
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['nickname' => $nickname], false), 
            $this->className
        );
    }

    public function updateEmail($userId, $email) {

        $sql = "UPDATE ".$this->tableName."
                SET email = :email
                WHERE id_user = :id";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email, 'id' => $userId]),
            $this->className
        );
    }

    
}