<?php

session_start();

include("infra/connect.php");

if($_SERVER['REQUEST_METHOD']=="POST"){
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $sql = "SELECT*FROM usuarios WHERE nome_usuiario = '$usuario' AND email = '$email'";
    $resultado = $conexao -> query($sql);
    if ($resultado -> num_rows > 0){
        $_SESSION ["usuario"] = $usuario;
        header("Location: public/home.php");
        exit();
    }else{
        $erro = "usuario/email invalidos";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title></title>
</head>
<body>
    
</body>
</html>