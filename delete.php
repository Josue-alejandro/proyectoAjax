<?php
include 'database.php';  

if(isset($_POST['id'])){

$id = $_POST['id'];

$query = "DELETE FROM tareas WHERE id = '$id'";

$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	die('Query failed');
}

echo "Borrada";
}

?>