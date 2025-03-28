<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class TopicManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function findTopicsByCategory($id) {

        $sql = "SELECT * 
                FROM ".$this->tableName." t 
                WHERE t.category_id = :id
                ORDER BY creationDate DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function findTopicsById($id) {
       
       $sql = "SELECT * 
            FROM ".$this->tableName." t 
            WHERE t.user_id = :id
            ORDER BY creationDate DESC";

        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }

    public function changeTopicLockdown($id, $newState) {

        $sql = "UPDATE ".$this->tableName."
                SET closed = :state
                WHERE id_topic = :id";

        return $this->getOneOrNullResult(
            DAO::select($sql, ['id' => $id, 'state' => $newState]),
            $this->className
        );
    }




}