<?php

include("infra/conexao.php");

$id_pratos = $_GET["id_pratos"];
$sql = "DELETE FROM pratos WHERE id_pratos = $id_pratos";
mysqli_query($conexao,$sql);

header("location: ../index.php");









?>