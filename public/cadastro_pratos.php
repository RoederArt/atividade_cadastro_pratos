<?php

session_start();

include("../infra/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nome = $_POST["nome_prato"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $sql_insert = "INSERT INTO pratos (nome_pratos, descrição_pratos, preço_pratos, categoria_pratos)VALUES ('$nome', '$descricao', '$preco', '$categoria')";

    $conexao->query($sql_insert);
}

$sql_select = "SELECT * FROM pratos";
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
        <label for="id_usuario">Usuário responsável</label>
        <select name="id_usuario" id="id_usuario" class="form-select" required>
            <option value="">Selecione um usuário...</option>
            <?php while ($usuario = mysqli_fetch_assoc($usuario)) { ?>
                <option value="<?php echo $usuario['id_usuario']; ?>">
                    <?php echo $usuario['nome_usuario']; ?>
                </option>
            <?php } ?>
        </select>
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
    <h2>pratos cadastrados</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>nome</th>
            <th>descrição</th>
            <th>preço</th>
            <th>categoria</th>
        </tr>

        <?php while ($prato = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $prato['id_pratos']; ?></td>
                <td><?php echo $prato['nome_pratos']; ?></td>
                <td><?php echo $prato['descrição_pratos']; ?></td>
                <td>R$ <?php echo $prato['preço_pratos']; ?></td>
                <td><?php echo $prato['categoria_pratos']; ?></td>
            </tr>

        <?php } ?>

    </table>

</body>

</html>