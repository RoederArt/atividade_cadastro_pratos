<?php

session_start();

include("infra/conexao.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $sql = "SELECT*FROM usuarios WHERE nome_usuario = '$usuario' AND email_usuario = '$email'";
    $resultado = $conexao -> query($sql);
    if ($resultado -> num_rows > 0){
        $erro = "usuario ja cadastrado";
    }else{

        $sql = "INSERT INTO usuarios (nome_usuario, email_usuario) VALUES ('$usuario', '$email')";

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
    <title>cadastro_usuarios</title>
</head>
<body>

<header></header>

<h1>
<a href="public/cadastro_pratos.php">CADASTRO PRATOS</a>
</h1>
</body>
</html>