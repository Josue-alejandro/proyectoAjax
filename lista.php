<?php
include 'database.php';

$query = "SELECT * FROM tareas";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	die("query failed" . mysqli_error($conn));
}

$json = array();
while ($row = mysqli_fetch_array($resultado)) {
	$json[] = array(
		'nombre' => $row['titulo'],
		'descripcion' => $row['descripcion'],
		'id' => $row['id'],
		'fecha' => $row['fecha'],
	);
}
$jsonstring = json_encode($json);
echo $jsonstring;
 ?>