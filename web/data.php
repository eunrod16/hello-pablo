<?php
use Google\Cloud\Storage\StorageClient;
session_start();
if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

$post = json_decode(file_get_contents('php://input'), true);

if ( isSet( $post["nombre"] ) ) {
	array_push( $_SESSION['data'], array( "nombre"=>$post["nombre"], "telefono"=>$post["telefono"] ) );
}

//echo json_encode( $_SESSION['data'] );

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/media_proyecto.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, '{"id_proyecto":1,"link_media":"link de imagen 3"}' );


$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$method = "GET";
$data = "";

switch ($method) {
	case "GET":
	//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
	break;
	case "POST":
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	break;
	case "PUT":
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	break;
	case "DELETE":
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	break;
}
$response = curl_exec($curl);
$data = json_decode($response);
echo json_encode($data);
//echo $data


upload_object("hopeforzeropolio.appspot.com","lang-logo.png","/images/lang-logo.png");
/**
* Upload a file.
*
* @param string $bucketName The name of your Cloud Storage bucket.
* @param string $objectName The name of your Cloud Storage object.
* @param string $source The path to the file to upload.
*/
function upload_object($bucketName, $objectName, $source)
{
	// $bucketName = 'my-bucket';
	// $objectName = 'my-object';
	// $source = '/path/to/your/file';

	$storage = new StorageClient([
	    'projectId' => "hopeforzeropolio"
	]);
	$file = fopen($source, 'r');
	$bucket = $storage->bucket($bucketName);
	$object = $bucket->upload($file, [
		'name' => $objectName
	]);
	printf('Uploaded %s to gs://%s/%s' . PHP_EOL, basename($source), $bucketName, $objectName);
}

?>
