<?php
require('../vendor/autoload.php');






$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");


$response = curl_exec($curl);
$data = json_decode($response);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);
$asignacion_proyectos = json_decode($response);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);
$orden_proyecto = json_decode($response);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/media_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);
$media = json_decode($response);


$dataenviar=new class{};
$dataenviar->proyectos = $data;
$dataenviar->asignacion = $asignacion_proyectos;
$dataenviar->orden = $orden_proyecto;
$dataenviar->media = $media;





echo json_encode($dataenviar);
//echo $data




?>
