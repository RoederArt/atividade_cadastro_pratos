<?php

include("infra/conexao.php");

$id_pratos = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM pratos WHERE id_pratos = $id_pratos";

$resultado = mysqli_query( $conexao,  $sql);
$prato = mysqli_fetch_assoc($resultado);



$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usuario_id = (int) $_POST['usuario'];
    $nome = $_POST["nome_prato"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];

     $sql = "UPDATE pratos SET nome = ?, descricao = ?, preco = ?, categoria = ?, id_usuario = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsi', $nome, $descricao, $preco, $categoria, $usuario_id, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Prato atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } 
    
    }

?>

