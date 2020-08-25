<?php
$bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=" . BDDNAMEJOGU . ";charset=utf8", BDDNAMEJOGU, BDDPWDJOGU);
$nettoyage = $bdd->exec('DELETE FROM jf_bruteforce');
//$nettoyage->closeCursor();

//Nettoi la table jf_bruteforce chaque heure pour éviter le spam du formulaire de connection 