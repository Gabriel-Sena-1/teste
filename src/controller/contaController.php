<?php

require_once __DIR__ . '/../model/contaModel.php';

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

        case 'editar':
            if (!empty($_GET['id_conta_pagar']) && !empty($_GET['valor']) && !empty($_GET['data_pagar'])) {
                $id_conta_pagar = $_GET['id_conta_pagar'];
                $valor = $_GET['valor'];
                $data_pagar = $_GET['data_pagar'];
                echo 'entrou';
                $atualizaConta = atualizaConta($id_conta_pagar, $valor, $data_pagar);

                if ($atualizaConta) {
                    $msg = "Conta atualizada com sucesso!!";
                } else {
                    $msg = "Erro ao atualizar a conta.";
                }
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;


        case 'atualizaStatus':
            $id_conta_pagar = $_GET['id_conta_pagar'];
            $valor = $_GET['valor'];
            $atualizaConta = atualizaStatusConta($id_conta_pagar, $valor);

            if ($atualizaConta) {
                $msg = "Conta paga com sucesso!!";
            } else {
                $msg = "Erro ao pagar a conta.";
            }
            header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
            exit();
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
