<?php

include("../infra/conexao.php");

$id_pratos = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "DELETE FROM pratos WHERE id_pratos = ?";
$comando = $conexao->prepare($sql);
$comando->bind_param("i", $id_pratos);
$comando->execute();
header("location: cadastro_pratos.php");









?>