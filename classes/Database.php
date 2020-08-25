<?php

class Database { //Class Parent de jf_usermanager.php, se connecte a la BDD
 
    protected $bdd;
    
    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=" . BDDNAMEJOGU . ";charset=utf8", BDDNAMEJOGU, BDDPWDJOGU);
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

}