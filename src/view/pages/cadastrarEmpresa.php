<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar empresa</title>
    <?php
    if (isset($_GET['msg'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['msg']) . '");</script>';
    }
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
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

        main {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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