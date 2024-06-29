<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
    <link rel="stylesheet" href="./../css/style.css">
    <script></script>
    <style>
        /* Estilo para o contêiner do formulário */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        /* Estilo para o título do formulário */
        .form-container h1 {
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Estilo para os campos de entrada */
        .form-container input[type="date"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 1rem;
            box-sizing: border-box;
            /* Para incluir padding e border no width */
        }

        /* Estilo para o botão de envio */
        .form-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        /* Estilo base para o select */
        select#empresa {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            appearance: none;
            /* Remove o estilo padrão do sistema operacional */
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            cursor: pointer;
        }

        /* Estilo quando o select está focado */
        select#empresa:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        /* Estilo para as opções do select */
        select#empresa option {
            padding: 10px;
            font-size: 1rem;
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        td a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }
        td a:hover {
            text-decoration: underline;
        }
    </style>
    <?php
    require_once __DIR__.'./../../controller/empresaController.php';
    require_once __DIR__.'./../../model/empresaModel.php';
    $empresas = listarEmpresa();

    if (isset($_GET['msg'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['msg']) . '");</script>';
    }

    ?>
</head>

<body>
    <header>
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