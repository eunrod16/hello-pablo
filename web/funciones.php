<?php

function delete_firebase($post){

// JSON MEDIA PROYECTOS

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/media_proyecto/".$post["nombre_proyecto"].".json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
$response = curl_exec($curl);

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

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);

$orden_proyecto = json_decode($response,true);
$arraycofcof =  $orden_proyecto->cofcof;
$arraypersonal =  $orden_proyecto->personal;
$nombredelproyecto = $post["nombre_proyecto"];
//$arraycofcof =  $post["proyectoscofcof"];
//$arraypersonal =  $post["proyectoscofcof"];

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
}
//echo $data


// JSON ORDEN PROYECTO
function create_firebase($post){
$post["cofcof"] =  explode(",", $post["cofcof"]);
$post["personal"] =  explode(",", $post["personal"]);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto.json";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$response = curl_exec($curl);

$orden_proyecto = json_decode($response);
$nombredelproyecto = $post["nombre_proyecto"];
$arraycofcof =  $orden_proyecto->cofcof;
$arraypersonal =  $orden_proyecto->personal;
$nuevo_valor=new class{};
$nuevo_valor->name = $post["nombre_proyecto"];
array_unshift($arraycofcof , $nuevo_valor);
array_unshift($arraypersonal , $nuevo_valor);

$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/cofcof.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($arraycofcof) );
$response = curl_exec($curl);
$url = "https://porfolio-b6670-default-rtdb.firebaseio.com/orden_proyecto/personal.json";
$curl = curl_init();
curl_setopt( $curl, CURLOPT_URL, $url );
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
curl_setopt( $curl, CURLOPT_POSTFIELDS, json_encode($arraypersonal) );
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
