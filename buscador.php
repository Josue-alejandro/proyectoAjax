<?php include 'database.php';

$buscador = $_POST['search'];

if (!empty($buscador)) {
	$query = "SELECT * FROM  tareas WHERE titulo LIKE '$buscador%'";
	$resultado = mysqli_query($conn, $query);
	if (!$resultado) {
		die("Query error " . mysqli_error($conn));
	}

	$json = array();
	while ($row = mysqli_fetch_array($resultado)) {
		$json[] = array(
			'nombre' => $row['titulo'],
			'descripcion' => $row['descripcion'],
			'id' => $row['id'],
		);
	};

	$jsonstring = json_encode($json);
	echo $jsonstring;
}


 ?>