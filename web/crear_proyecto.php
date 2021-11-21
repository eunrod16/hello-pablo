<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

// if ( isSet( $post["nombre"] ) ) {
// 	array_push( $_SESSION['data'], array( "nombre"=>$post["nombre"], "telefono"=>$post["telefono"] ) );
// }
$data = {
	nombre_proyecto: "",
	descripcion:"",
	cliente:"",
	software:"",
	fecha_inicio:"",
	fecha_fin:""

}

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($post) );

$response = curl_exec($curl);
$data = json_decode($response);
echo json_encode($data);
//echo $data




?>