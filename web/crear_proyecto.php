<?php
//session_start();
//if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

//$post = json_decode(file_get_contents('php://input'), true);
require('../vendor/autoload.php');

use Google\Cloud\Storage\StorageClient;
$post = $_POST;


function upload_object_cloud($bucketName, $objectName, $source)
{
	$storage = new StorageClient([
	    'projectId' => "hopeforzeropolio"
	]);
	putenv('GOOGLE_APPLICATION_CREDENTIALS=hopeforzeropolio-f53ec920a5e0.json');
	$file = fopen($source, 'r');
	$bucket = $storage->bucket($bucketName);
	$object = $bucket->upload($file, [
		'name' => $objectName
	]);
}

function upload_file_server(){
  $filename = $_FILES['file']['name'];
  $nombre_proyecto = $_POST['nombre_proyecto'];
  $valid_extensions = array("jpg","jpeg","png","pdf");
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  if(in_array(strtolower($extension),$valid_extensions) ) {
     if(move_uploaded_file($_FILES['file']['tmp_name'], __DIR__."/images/f".$filename)){
        upload_object_cloud("hopeforzeropolio.appspot.com",$filename,__DIR__."/images/f".$filename);
        $post['portada']= "firebasestorage.googleapis.com/v0/b/hopeforzeropolio.appspot.com/o/".$filename."?alt=media&token=ae3bd583-bafe-486e-b499-82b1d70b4615";

     }else{
        echo 0;
     }
  }else{
     echo 0;
  }
}


// JSON ORDEN PROYECTO
function create_firebase(){
$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);

$orden_proyecto = json_decode($response);
$nombredelproyecto = $post["nombre_proyecto"];
$arraycofcof =  $orden_proyecto->cofcof;
$arraypersonal =  $orden_proyecto->personal;

$nuevo_valor={"name":$post["nombre_proyecto"]};
array_unshift($arraycofcof , $nuevo_valor);
$nuevo_valor={"name":$post["nombre_proyecto"]};
array_unshift($arraypersonal , $nuevo_valor);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/cofcof.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($nuevo_array) );
$response = curl_exec($curl);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/personal.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($nuevo_array) );
$response = curl_exec($curl);


// JSON PAGINA PROYECTO
$asignacion_proyectos->nombre_proyecto =  $post["nombre_proyecto"];
$asignacion_proyectos->checked = false;

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto/cofcof/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($asignacion_proyectos) );
$response = curl_exec($curl);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/pagina_proyecto/personal/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($asignacion_proyectos) );
$response = curl_exec($curl);

// JSON PROYECTOS

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/proyectos/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($post) );

$response = curl_exec($curl);
$data = json_decode($response);
echo json_encode($data);
//echo $data
}



?>
