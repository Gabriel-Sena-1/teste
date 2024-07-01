<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
    <link rel="stylesheet" href="./../css/controleDeContas.css">
    <link rel="icon" href="./../img/favicon-32x32.png" type="image/x-icon">
    <script src="./../js/mainFunctions.js" type="text/javascript"></script>
    <style>
        
    </style>
    <?php
    require_once __DIR__ . './../../controller/empresaController.php';
    require_once __DIR__ . './../../model/empresaModel.php';
    $empresas = listarEmpresa();

    if (isset($_GET['msg'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['msg']) . '");</script>';
    }

    ?>
</head>

<body>
    <header style="margin-bottom: 30px;">
        <a href="./cadastrarEmpresa.php">
            <button type="button">Cadastro de empresas</button>
        </a>
    </header>

    <main>
        <div class="form-container">
            <form action="./../../controller/contaController.php">
                <h1>Adicionar conta a pagar:</h1>
                <input name="action" id="action" hidden value="cadastrar">
                <label for="empresa">Selecione uma empresa:</label>
                <select name="empresa" id="empresa">
                    <?php foreach ($empresas as $empresa) { ?>
                        <option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nome']; ?></option>
                    <?php } ?>
                </select>
                <br>
                <label for="date">Data</label>
                <input type="date" name="data_pagamento" id="data_pagamento">
                <label for="valor">Valor</label>
                <input type="number" name="valor" id="valor_pagar" placeholder="Valor a pagar">
                <button type="submit">Cadastrar conta</button>
            </form>
        </div>

        <div id="popEditar" style="z-index: 1000; display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffffff; width: 400px; padding: 80px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); border-radius: 5px;">
            <form action="./../../controller/contaController.php" style="display: flex; flex-direction: column;">
                <h1 style="text-align: center; margin-bottom: 20px;">Editar conta:</h1>
                <input name="action" id="action" hidden value="editar">
                <input type="number" name="id_conta_pagar" id="id_conta_pagar" value="" hidden>
                <label for="date" style="margin-bottom: 10px;">Nova Data:</label>
                <input type="date" name="data_pagar" id="data_pagar" style="padding: 8px; margin-bottom: 10px;" required>
                <label for="valor" style="margin-bottom: 10px;">Novo valor:</label>
                <input type="number" name="valor" id="valor" placeholder="Novo valor a pagar" style="padding: 8px; margin-bottom: 20px;" required>
                <button type="submit" onclick="return confirm('Tem certeza que deseja editar esta conta?')" style="padding: 10px; background-color: #007bff; color: #ffffff; border: none; cursor: pointer;">Editar conta</button>
            </form>
        </div>


        <div style="display: flex; flex-direction: column; margin-bottom: -50px; margin-top: 30px;" id="divPaiFiltro">
            <div style="text-align: center;" id="divFiltro">
                <p style="font-weight: 600;">PESQUISAR EMPRESA: <input type="text"></p>
            </div>
        </div>

        <div style="margin: 40px;">
            <?php
            tableEmpresasContas();
            ?>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>