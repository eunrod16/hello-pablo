<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

if ( isSet( $post["nombre"] ) ) {
	array_push( $_SESSION['data'], array( "nombre"=>$post["nombre"], "telefono"=>$post["telefono"] ) );
	}

echo json_encode( $_SESSION['data'] );
?>
