<?php
include("config.php");

$cliente_cod = intval($_GET['codigo']);

$sql = "DELETE FROM clientes WHERE cli_cod = '$cliente_cod'";
$result = mysqli_query($conn, $sql);

header("Location: home.php")
?>
