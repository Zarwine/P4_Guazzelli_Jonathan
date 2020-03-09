<?php 
include_once('_config.php');

MyAutoLoad::start();

if(!isset($_GET['r'])){
    header('Location: home');
}

$request = $_GET['r'];


//echo '<pre>'; var_dump($_SERVER);
//echo '<pre>'; print_r($request);
//exit();

$routeur = new Routeur($request);
$routeur->renderController();

