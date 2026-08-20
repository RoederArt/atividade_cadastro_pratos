<?php

session_start();

include("../infra/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nome = $_POST["nome_prato"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria"];
    $id_usuario = $_POST["id_usuario"];

    $sql_insert = "INSERT INTO pratos (nome_pratos, descrição_pratos, preço_pratos, categoria_pratos, id_usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql_insert);
    $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $categoria, $id_usuario);
    $stmt->execute();
    $stmt->close();
}

$sql_select = "SELECT * FROM pratos";
$resultado = mysqli_query($conexao, $sql_select);

$sql_select_usuario = "SELECT * FROM usuarios";
$usuarios = mysqli_query($conexao, $sql_select_usuario);

?>

<!DOCTYPE html>
<html lang="Br">

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
            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?php echo $usuario['id_usuario']; ?>">
                    <?php echo $usuario['nome_usuario']; ?>
                </option>
            <?php } ?>
        </select>
        <br>
        <label for="nome_prato">nome prato:</label>
        <input type="text" name="nome_prato" required>
        <br>
        <label for="descricao">descrição:</label>
        <input type="text" name="descricao" required>
        <br>
        <label for="preco">preço:</label>
        <input type="text" name="preco" required>
        <br>
        <label for="categoria">categoria:</label>
        <input type="text" name="categoria" required>
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
                <td><?php echo htmlspecialchars($prato['nome_pratos']); ?></td>
                <td><?php echo htmlspecialchars($prato['descrição_pratos']); ?></td>
                <td><?php echo htmlspecialchars($prato['preço_pratos']); ?></td>
                <td><?php echo htmlspecialchars($prato['categoria_pratos']); ?></td>

                <td>
                  <a href="editar.php?id=<?php echo $prato['id_pratos']; ?>">Editar</a> | 
                <a href="excluir.php?id=<?php echo $prato['id_pratos']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>

                </td>
            </tr>
        <?php } ?>

    </table>

    <a href="../index.php">VOLTAR</a>

</body>

</html>