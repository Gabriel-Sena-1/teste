<?php

require_once __DIR__ . '/../model/contaModel.php';
echo 'entrou';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
    echo $action;
    switch ($action) {
        case 'apagar':
            if (!empty($_GET['id_conta'])) {
                $id_conta_pagar = $_GET['id_conta'];
                $id_empresa = $_GET['id_empresa'];
                $apagarConta = deletaConta($id_conta_pagar, $id_empresa);

                if ($apagarConta) {
                    $msg = "Conta deletada com sucesso!!";
                } else {
                    $msg = "Erro ao deletar a conta.";
                }
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        case 'atualizar':
            if (!empty($_POST['id_conta_pagar']) && !empty($_POST['valor']) && !empty($_POST['data_pagar']) && isset($_POST['pago']) && !empty($_POST['id_empresa'])) {
                $id_conta_pagar = $_POST['id_conta_pagar'];
                $valor = $_POST['valor'];
                $data_pagar = $_POST['data_pagar'];
                $pago = $_POST['pago'];
                $id_empresa = $_POST['id_empresa'];

                $atualizaConta = atualizaConta($id_conta_pagar, $valor, $data_pagar, $pago, $id_empresa);

                if ($atualizaConta) {
                    $msg = "Conta atualizada com sucesso!!";
                } else {
                    $msg = "Erro ao atualizar a conta.";
                }
                header("Location: ./../view/pages/home.php?msg=$msg");
                exit();
            }
            break;

        case 'cadastrar':
            echo 'entrou';
            if (!empty($_GET['valor']) && !empty($_GET['data_pagamento']) && !empty($_GET['empresa'])) {
                echo 'entrou';
                $valor = $_GET['valor'];
                $data_pagar = $_GET['data_pagamento'];
                $pago = 0;
                $id_empresa = $_GET['empresa'];

                $cadastraConta = cadastraConta($valor, $data_pagar, $pago, $id_empresa);

                if ($cadastraConta) {
                    $msg = "Conta cadastrada com sucesso!!";
                } else {
                    $msg = "Erro ao cadastrar a conta.";
                }
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        default:
            $msg = "Ação inválida.";
            header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
            exit();
    }
}

function tableContas(){
    $listaContas = listarContas();
    $table = '';
    foreach ($listaContas as $conta) {
        $table .= '<tr>
        <td>'.$conta['valor'].'</td>
        <td>'.$conta['data_pagar'].'</td>
        <td>'.$conta['pago'].'</td>
        <td>'.$conta['id_empresa'].'</td>
        </tr>
        ';
    }
}