<?php

session_start();

include("infra/conexao.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $sql = "SELECT*FROM pratos WHERE nome_pratos = '$nome' AND descrição_pratos = '$descricao' AND preço_pratos = '$preco' AND categoria_pratos = '$categoria'";
    $resultado = $conexao -> query($sql);
    if ($resultado -> num_rows > 0){
        $erro = "prato ja cadastrado";
    }else{

        $sql = "INSERT INTO pratos (nome_pratos, descrição_pratos, preço_pratos, categoria_pratos)VALUES ($nome $descricao $preco $categoria)";

        if($conexao-> query($sql)){
            $_SESSION['nome_pratos'] = $usuario;

            exit();
        }else{
            $erro = "erro ao fazer cadastro de prato";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro_pratos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header></header>

<form action="public/cadastrar.php" method="POST">
        <label for="usuario">nome prato:</label>
        <input type="text" name="nome_prato">
        <br>
        <label for="email">desrição:</label>
        <input type="text" name="descricao">
        <br>
        <label for="email">preço:</label>
        <input type="text" name="preco">
        <br>
        <label for="email">categoria:</label>
        <input type="text" name="categoria">
        <br>
        <button type="submit">Cadastrar</button>
</form>
<h2>usuarios cadastrados</h2>
<table>
<tr>
        <th>ID</th>
        <th>nome</th>
        <th>descrição</th>
        <th>preço</th>
        <th>categoria</th>
</tr>
</table>
    
</body>
</html>