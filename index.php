<?php 
include_once('_config.php');

MyAutoLoad::start();

$request = $_GET['r'];

$routeur = new Routeur($request);
$routeur->renderController();

