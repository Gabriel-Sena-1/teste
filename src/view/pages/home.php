<?php
    require './../../controller/contaController.php';
    require './../../controller/empresaController.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contas</title>
    <link rel="stylesheet" href="./../css/style.css">
    <script></script>
    <?php if(isset($msg) & !empty($msg)){ echo `<script>alert($msg);</script>`; } ?>
</head>
<body>
    <header>

    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php listarContas(); ?>
            </tbody>
        </table>
        
    </main>
    
    <footer>

    </footer>
</body>
</html>