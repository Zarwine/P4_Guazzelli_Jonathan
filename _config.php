<?php
ini_set('display_errors','on');
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('HOST', 'https://'.$host.'/forteroche/');
define('ROOT', $root.'/forteroche/');

define("CONTROLLER", ROOT.'controller/');
define("VIEW", ROOT."view/");
define("MODEL", ROOT."model/");
define("CLASSES", ROOT.'classes/');

define("ASSETS", HOST."assets/");