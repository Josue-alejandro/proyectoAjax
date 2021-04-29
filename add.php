<?php  

include 'database.php';

if (isset($_POST['name'])) {
	$nombre = $_POST['name'];
	$descripcion = $_POST['description'];
	$query = "INSERT INTO tareas (titulo, descripcion) VALUES ('$nombre', '$descripcion')";

	$resultado = mysqli_query($conn, $query);
	if (!$resultado) {
		die("query failed");
	}

	echo "tarea añadida";
}

?>