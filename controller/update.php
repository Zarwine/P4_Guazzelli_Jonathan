<?php
include_once('config.php');

$values = $_POST['values'];

$bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");

if(!isset($values['id']))
{
    $query = "INSERT INTO jf_article (id, name, content, created_at)
    VALUES (NULL, :name, :content, NULL);";
} else {
    $query = "UPDATE jf_article SET name = :name, content = :content"
}
$req = $bdd->prepare($query);

if(iset($values['id'])) $req->bindValue(':id',$values['id'], PDO::PARAM_INT);
$req->bindValue(":name", $values["name"], PDO::PARAM_STR);
$req->bindValue(":content", $values['content'], PDO::PARAM_STR);

$req-execute()

header("Location: index.php");
exit;

;?>