<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);



$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );



$response = curl_exec($curl);
$data = json_decode($response);
echo json_encode($data);
//echo $data




?>
