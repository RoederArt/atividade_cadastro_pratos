<?php

session_start();

include("infra/connect.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $sql = "SELECT*FROM usuarios WHERE nome_usuario = '$usuario' AND email = '$email'";
    $resultado = $conexao -> query($sql);
    if ($resultado -> num_rows > 0){
        $erro = "usuario ja cadastrado";
    }else{

        $sql = "INSERT INTO usuarios (nome_usuario, email)VALUES ($usuario $email)";

        if($conexao-> query($sql)){
            $_SESSION['usuario'] = $usuario;

            header("location: public/cadastro_pratos.php");
            exit();
        }else{
            $erro = "erro ao fazer cadastro";
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
        <label for="usuario">usuario:</label>
        <input type="text" name="usuario">
        <br>
        <label for="email">email:</label>
        <input type="text" name="email">
        <br>
        <button type="submit">Cadastrar</button>
</form>
<h2>usuarios cadastrados</h2>
<table>
        <tr>
        <th>ID</th>
        <th>usuario</th>
        <th>email</th>
</tr>
</table>
    
</body>
</html>