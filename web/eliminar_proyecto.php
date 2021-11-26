<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

require('../vendor/autoload.php');
require('funciones.php');

delete_firebase($post)





?>
