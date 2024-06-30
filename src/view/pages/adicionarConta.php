<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
    <link rel="stylesheet" href="./../css/style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filtroEmpresaInput = document.querySelector('#divFiltro input[type="text"]');
            const tabelasEmpresas = document.querySelectorAll('.tabelaEmpresas');

            filtroEmpresaInput.addEventListener('input', function() {
                const textoFiltro = this.value.trim().toLowerCase();

                tabelasEmpresas.forEach(tabela => {
                    const nomeEmpresa = tabela.getAttribute('data-nome').toLowerCase();

                    if (nomeEmpresa.includes(textoFiltro)) {
                        tabela.style.display = ''; // Mostra a tabela se o nome corresponder ao filtro
                    } else {
                        tabela.style.display = 'none'; // Oculta a tabela se o nome não corresponder ao filtro
                    }
                });
            });
        });

        function editarConta(idConta) {
            var popEditar = document.getElementById('popEditar');
            var idEditar = document.getElementById('id_conta_pagar');
            popEditar.style.display = 'flex';
            popEditar.style.flexDirection = 'column';
            popEditar.style.position = 'fixed';
            popEditar.style.top = '50%';
            popEditar.style.left = '50%';
            popEditar.style.transform = 'translate(-50%, -50%)';
            popEditar.style.zIndex = '1000';
            popEditar.style.backgroundColor = '#ffffff';
            popEditar.style.padding = '20px';
            popEditar.style.boxShadow = '0 0 20px rgba(0, 0, 0, 0.2)';
            popEditar.style.borderRadius = '5px';
            idEditar.value = idConta;
        }
    </script>
    <style>
        body {
            margin: 0;
        }

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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        th,
        td {
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

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        header a {
            text-decoration: none;
        }

        header button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        header button:hover {
            background-color: #45a049;
        }

        #divPaiFiltro {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        #divFiltro {
            text-align: center;
            margin-bottom: 10px;
        }

        #divFiltro input[type="text"] {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }
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
                <input type="date" name="data_pagar" id="data_pagar" style="padding: 8px; margin-bottom: 10px;">
                <label for="valor" style="margin-bottom: 10px;">Novo valor:</label>
                <input type="number" name="valor" id="valor" placeholder="Novo valor a pagar" style="padding: 8px; margin-bottom: 20px;">
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