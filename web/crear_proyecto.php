<?php
//session_start();
//if ( !isSet($_SESSION['data']) ) $_SESSION['data']=array();

//$post = json_decode(file_get_contents('php://input'), true);
require('../vendor/autoload.php');
require('funciones.php');

use Google\Cloud\Storage\StorageClient;
$post = $_POST;
if(isset($_POST["nombre_proyecto"])){
  $portada = upload_file_server();
  $post["portada"]= $portada;
  $post["cofcof"] =  explode(",", $post["cofcof"]);
  $post["personal"] =  explode(",", $post["personal"]);
  echo create_firebase($post);
}
else{
  echo 0;
}


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
  $valid_extensions = array("jpg","jpeg","png","pdf");
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  if(in_array(strtolower($extension),$valid_extensions) ) {
     if(move_uploaded_file($_FILES['file']['tmp_name'], __DIR__."/images/f".$filename)){
        upload_object_cloud("hopeforzeropolio.appspot.com",$filename,__DIR__."/images/f".$filename);
        return "firebasestorage.googleapis.com/v0/b/hopeforzeropolio.appspot.com/o/".$filename."?alt=media&token=ae3bd583-bafe-486e-b499-82b1d70b4615";

     }else{
        echo 0;
     }
  }else{
     echo 0;
  }
}






?>
