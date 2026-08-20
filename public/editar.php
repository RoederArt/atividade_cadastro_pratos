<?php
session_start();
include("../infra/conexao.php");


$id_pratos = isset($_GET['id']) ? (int) $_GET['id'] : 0;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario_id = (int) $_POST['id_usuario'];
    $nome       = $_POST["nome_prato"];
    $descricao  = $_POST["descricao"];
    $preco      = $_POST["preco"];
    $categoria  = $_POST["categoria"];

    $sql_update = "UPDATE pratos 
                   SET nome_pratos = ?, descrição_pratos = ?, preço_pratos = ?, categoria_pratos = ?, id_usuario = ? 
                   WHERE id_pratos = ?";

    $stmt = mysqli_prepare($conexao, $sql_update);

    mysqli_stmt_bind_param($stmt, 'ssdsii', $nome, $descricao, $preco, $categoria, $usuario_id, $id_pratos);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: cadastro_pratos.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conexao);
    }
}


$sql_prato = "SELECT * FROM pratos WHERE id_pratos = ?";
$stmt_prato = mysqli_prepare($conexao, $sql_prato);
mysqli_stmt_bind_param($stmt_prato, 'i', $id_pratos);
mysqli_stmt_execute($stmt_prato);
$prato = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_prato));


if (!$prato) {
    header("Location: cadastro_pratos.php");
    exit();
}

// 4. Busca todos os usuários para o select
$sql_usuarios = "SELECT * FROM usuarios";
$usuarios = mysqli_query($conexao, $sql_usuarios);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Prato</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h2>Editar Prato</h2>

    <form method="POST">
        <label for="id_usuario">Usuário responsável</label>
        <select name="id_usuario" id="id_usuario" required>
            <option value="">Selecione um usuário</option>
            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                <option value="<?php echo $usuario['id_usuario']; ?>" 
                    <?php echo ($usuario['id_usuario'] == $prato['id_usuario']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($usuario['nome_usuario']); ?>
                </option>
            <?php } ?>
        </select>
        <br>

        <label for="nome_prato">Nome do prato:</label>
        <input type="text" name="nome_prato" value="<?php echo htmlspecialchars($prato['nome_pratos']); ?>" required>
        <br>

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($prato['descrição_pratos']); ?>" required>
        <br>

        <label for="preco">Preço:</label>
        <input type="text" name="preco" value="<?php echo htmlspecialchars($prato['preço_pratos']); ?>" required>
        <br>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($prato['categoria_pratos']); ?>" required>
        <br>

        <button type="submit">Salvar Alterações</button>
        <a href="cadastro_pratos.php">Cancelar</a>
    </form>

</body>
</html>