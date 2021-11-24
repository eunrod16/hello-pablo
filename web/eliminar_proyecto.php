<?php
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

// JSON PROYECTOS

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
$response = curl_exec($curl);

// JSON PÁGINA PROYECTOS

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto/cofcof/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
$response = curl_exec($curl);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto/personal/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
$response = curl_exec($curl);

// JSON ORDEN PROYECTOS


$nombredelproyecto = $post["nombre_proyecto"];
$arraycofcof =  $post["proyectoscofcof"];
$arraypersonal =  $post["proyectoscofcof"];

$nuevo_array=[];
foreach ($arraycofcof as &$valor) {
	if ($nombredelproyecto != $valor["name"])
		array_push($nuevo_array, $valor);
}
$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/cofcof.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($nuevo_array) );
$response = curl_exec($curl);

$nuevo_array=[];
foreach ($arraypersonal as &$valor) {
	if ($nombredelproyecto != $valor["name"])
		array_push($nuevo_array, $valor);
}
$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/personal.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($nuevo_array) );
$response = curl_exec($curl);


$data = json_decode($response);
echo json_encode($data);
//echo $data




?>
