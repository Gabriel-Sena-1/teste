<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar empresa</title>
    <link rel="icon" href="./../img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="./../css/cadastrarEmpresa.css">
    <?php
    if (isset($_GET['msg'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['msg']) . '");</script>';
    }
    ?>
</head>

<body>
    <header>
        <a href="./adicionarConta.php">
            <button type="button">Controle de contas</button>
        </a>
    </header>
    <main>
        <div>
            <form action="./../../controller/empresaController.php">
                <label for="nome_empresa">Nome da Empresa:</label>
                <input name="action" id="action" value="cadastrar" hidden>
                <input type="text" name="nome_empresa" id="nome_empresa">
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>

</html>