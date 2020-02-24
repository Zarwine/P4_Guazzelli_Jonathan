<?php
include_once('config.php');

$id = $_GET['id'];

$bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");

$query = "DELETE FROM jf_article WHERE id = :id";

$req = $bdd->prepare($query);
$req->bindValue(':id', $id, PDO::PARAM_INT);

$req-execute();

header("Location: index.php");
exit;

;?>