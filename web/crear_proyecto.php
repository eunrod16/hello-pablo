<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);


$asignacion_proyectos->nombre_proyecto =  $post["nombre_proyecto"];
$asignacion_proyectos->checked = 0;




$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto/cofcof/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($asignacion_proyectos) );

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($post) );

$response = curl_exec($curl);
$data = json_decode($response);
echo json_encode($data);
//echo $data




?>
