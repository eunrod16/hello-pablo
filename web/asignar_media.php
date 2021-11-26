<?php
require('../vendor/autoload.php');

use Google\Cloud\Storage\StorageClient;
$post = json_decode(file_get_contents('php://input'), true);


// ELIMINAR JSON MEDIA PROYECTOS

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/media_proyecto/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
$response = curl_exec($curl);

// AGREGAR MEDIA
$arraymedia = $post["media"];
foreach ($arraymedia as $media) {
	asign_link_object($media);
};

function asign_link_object($obj){
	$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/media_proyecto/".$post["nombre_proyecto"].".json";
	$curl = curl_init();
	curl_setopt( $curl, CURLOPT_URL, $url );
	curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt( $curl, CURLOPT_POSTFIELDS, $obj );
	$response = curl_exec($curl);
}
