<?php

include("../infra/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usuario = $_POST["usuario"];
    $email = $_POST["email"];

    $sql = "INSERT INTO usuarios (nome_usuario, email_usuario) VALUES ( ?, ?)";
    $comando = $conexao->prepare($sql);
    $comando->bind_param("ss", $usuario, $email);
    $comando->execute();

}

$sql_select = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql_select);

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

    <form method="POST">
        <label for="usuario">usuario:</label>
        <input type="text" name="usuario">
        <br>
        <label for="email">email:</label>
        <input type="email" name="email">
        <br>
        <button type="submit">Cadastrar</button>
    </form>
    <h2>pessoas cadastradas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>usuario</th>
            <th>email</th>
        </tr>

        <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $usuario['id_usuario']; ?></td>
                <td><?php echo $usuario['nome_usuario']; ?></td>
                <td><?php echo $usuario['email_usuario']; ?></td>
            </tr>

        <?php } ?>

    </table>

</body>

</html>