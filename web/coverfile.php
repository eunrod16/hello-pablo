<?php
require('../vendor/autoload.php');

use Google\Cloud\Storage\StorageClient;
$post = json_decode(file_get_contents('php://input'), true);

function upload_object($bucketName, $objectName, $source)
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




$filename = $_FILES['file']['name'];
$nombre_proyecto = $_POST['nombre_proyecto'];
$valid_extensions = array("jpg","jpeg","png","pdf");
$extension = pathinfo($filename, PATHINFO_EXTENSION);
if(in_array(strtolower($extension),$valid_extensions) ) {
   if(move_uploaded_file($_FILES['file']['tmp_name'], __DIR__."/images/f".$filename)){
      upload_object("hopeforzeropolio.appspot.com",$filename,__DIR__."/images/f".$filename);
      echo "firebasestorage.googleapis.com/v0/b/hopeforzeropolio.appspot.com/o/".$filename."?alt=media&token=ae3bd583-bafe-486e-b499-82b1d70b4615";
      echo 1;
   }else{
      echo 0;
   }
}else{
   echo 0;
}

exit;
