<?php
include 'database.php';

$id = $_POST['id'];
$query = "SELECT * FROM tareas WHERE id = $id";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	die('query failed');
}

$json = array();
while ($row = mysqli_fetch_array($resultado)) {
	$json[] = array(
		'titulo' => $row['titulo'],
		'descripcion' => $row['descripcion'],
		'id' => $row['id'],
	);
}

$jsonstring = json_encode($json[0]);
echo $jsonstring;

?>