<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

$nombredelproyecto = 'proyecto 6';
$array =  $post["proyectoscofcof"];
$nuevo_array=[];
foreach ($array as &$valor) {
	if ($nombredelproyecto != $valor["name"])
		array_push($nuevo_array, $valor);
}




$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/cofcof.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($nuevo_array) );

$response = curl_exec($curl);
$data = json_decode($response);


?>
