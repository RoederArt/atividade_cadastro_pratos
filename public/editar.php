<?php

include("infra/conexao.php");

$id_pratos = $_GET["id_pratos"];
$sql = "SELECT * FROM pratos WHERE id_pratos = $id_pratos";

$resultado = mysqli_query( $conexao,  $sql);
$prato = mysqli_fetch_assoc($resultado);





?>

