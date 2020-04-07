<?php

class Database {

    private $bdd;

    public function __construct()
    {   
        if(self::$bdd === NULL){
            try {
            self::$bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
            } catch (Exception $e) {
                throw new Exception("Erreur de connection à la BDD " . $e->getMessage());
            }
        }
        return self::$bdd;

    }
    public function getBDD(){
        self::$bdd;
        var_dump(self::$bdd);
    }
}