<?php 

include 'database.php';

$id = $_POST['id'];
$titulo = $_POST['name'];
$descripcion = $_POST['description'];

$query = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion' WHERE id = '$id'";

$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	die('query failed');
}

echo "tarea actualizada";

?>