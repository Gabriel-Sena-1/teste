<?php

// Inclui o arquivo do modelo de conta
require_once __DIR__ . '/../model/contaModel.php';

// Verifica se o parâmetro 'action' foi enviado via GET
if (!empty($_GET['action'])) {
    $action = $_GET['action']; // Obtém a ação a ser executada

    // Switch case para lidar com diferentes ações
    switch ($action) {
        case 'apagar':
            // Verifica se os parâmetros necessários foram passados
            if (!empty($_GET['id_conta'])) {
                $id_conta_pagar = $_GET['id_conta'];
                $id_empresa = $_GET['id_empresa'];

                // Chama a função para deletar a conta
                $apagarConta = deletaConta($id_conta_pagar, $id_empresa);

                // Verifica se a conta foi deletada com sucesso
                if ($apagarConta) {
                    $msg = "Conta deletada com sucesso!!";
                } else {
                    $msg = "Erro ao deletar a conta.";
                }
                // Redireciona de volta para a página com a mensagem
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        case 'editar':
            // Verifica se os parâmetros necessários foram passados
            if (!empty($_GET['id_conta_pagar']) && !empty($_GET['valor']) && !empty($_GET['data_pagar'])) {
                $id_conta_pagar = $_GET['id_conta_pagar'];
                $valor = $_GET['valor'];
                $data_pagar = $_GET['data_pagar'];

                // Chama a função para atualizar a conta
                $atualizaConta = atualizaConta($id_conta_pagar, $valor, $data_pagar);

                // Verifica se a conta foi atualizada com sucesso
                if ($atualizaConta) {
                    $msg = "Conta atualizada com sucesso!!";
                } else {
                    $msg = "Erro ao atualizar a conta.";
                }
                // Redireciona de volta para a página com a mensagem
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        case 'atualizaStatus':
            // Verifica se os parâmetros necessários foram passados
            if (!empty($_GET['id_conta_pagar']) && !empty($_GET['valor'])) {
                $id_conta_pagar = $_GET['id_conta_pagar'];
                $valor = $_GET['valor'];

                // Chama a função para atualizar o status da conta
                $atualizaConta = atualizaStatusConta($id_conta_pagar, $valor);

                // Verifica se o status da conta foi atualizado com sucesso
                if ($atualizaConta) {
                    $msg = "Conta paga com sucesso!!";
                } else {
                    $msg = "Erro ao pagar a conta.";
                }
                // Redireciona de volta para a página com a mensagem
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        case 'cadastrar':
            // Verifica se os parâmetros necessários foram passados
            if (!empty($_GET['valor']) && !empty($_GET['data_pagamento']) && !empty($_GET['empresa'])) {
                $valor = $_GET['valor'];
                $data_pagar = $_GET['data_pagamento'];
                $pago = 0; // Valor padrão para não pago
                $id_empresa = $_GET['empresa'];

                // Chama a função para cadastrar uma nova conta
                $cadastraConta = cadastraConta($valor, $data_pagar, $pago, $id_empresa);

                // Verifica se a conta foi cadastrada com sucesso
                if ($cadastraConta) {
                    $msg = "Conta cadastrada com sucesso!!";
                } else {
                    $msg = "Erro ao cadastrar a conta.";
                }
                // Redireciona de volta para a página com a mensagem
                header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
                exit();
            }
            break;

        default:
            // Ação inválida
            $msg = "Ação inválida.";
            header("Location: ./../view/pages/adicionarConta.php?msg=$msg");
            exit();
    }
}
?>
