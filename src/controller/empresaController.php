<?php

// Inclui o arquivo do modelo de empresa
require_once __DIR__ . './../model/empresaModel.php';

// Verifica se o parâmetro 'action' foi enviado via GET
if (!empty($_GET['action'])) {
    $action = $_GET['action']; // Obtém a ação a ser executada
    echo $action; // Exibe a ação (para fins de depuração)

    // Verifica se o parâmetro 'nome_empresa' foi enviado via GET
    if (!empty($_GET['nome_empresa'])) {
        $nomeEmpresa = $_GET['nome_empresa'];
        
        // Chama a função para cadastrar uma nova empresa
        $cadastrarEmpresa = cadastraEmpresa($nomeEmpresa);

        // Verifica se o cadastro da empresa foi bem-sucedido
        if ($cadastrarEmpresa) {
            $msg = "Empresa cadastrada com sucesso!!";
        } else {
            $msg = "Erro ao cadastrar empresa.";
        }
        
        // Redireciona para a página de cadastro de empresa com a mensagem
        header("Location: ./../view/pages/cadastrarEmpresa.php?msg=$msg");
        exit(); // Encerra o script após o redirecionamento
    }
}

// Função para formatar data no formato 'd/m/Y'
function formatarData($data)
{
    $dataFormatada = date_create_from_format('Y-m-d', $data);
    return date_format($dataFormatada, 'd/m/Y');
}

// Função para comparar data e retornar valor baseado na comparação
function comparaDataRetornaValor($dataComparacao, $valor)
{
    $dataAtual = new DateTime();
    $dataComparacao = new DateTime($dataComparacao); // Converter para DateTime

    if ($dataAtual > $dataComparacao) {
        return $valor * 1.1; // Aumenta o valor em 10% se a data atual for posterior
    } elseif ($dataAtual < $dataComparacao) {
        return $valor * 0.95; // Reduz o valor em 5% se a data atual for anterior
    } else {
        return $valor; // Retorna o valor sem alterações se as datas forem iguais
    }
}

// Função para exibir a tabela de contas das empresas
function tableEmpresasContas()
{
    $empresasContas = listarEmpresaConta(); // Obtém a lista de empresas e suas contas

    foreach ($empresasContas as $empresa) {
        if (!empty($empresa['contas'])) {
            echo '<table class="tabelaEmpresas" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 5px;" data-nome="' . htmlspecialchars($empresa['nome']) . '">';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="7" style="background-color: #f2f2f2; text-align: center; padding: 10px; font-weight: bold;">' . htmlspecialchars($empresa['nome']) . '</th>'; // Nome da empresa
            echo '</tr>';
            echo '<tr>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">ID da Conta</th>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;"><p onclick="ordenarTabela(this)">Valor</p></th>'; // Título da coluna Valor (com função JS para ordenar)
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Data de Pagamento</th>'; // Coluna Data de Pagamento
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Excluir</th>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Editar</th>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Status</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($empresa['contas'] as $conta) {
                echo '<tr style="text-align: center;">';
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;">' . htmlspecialchars($conta['id_conta_pagar']) . '</td>'; // ID da conta
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;">R$ ' . number_format($conta['valor'], 2, ',', '.') . '</td>'; // Valor formatado
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;">' . formatarData(htmlspecialchars($conta['data_pagar'])) . '</td>'; // Data de pagamento
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a onclick="return confirm(\'Tem certeza que deseja apagar esta conta?\')" href="./../../controller/contaController.php?action=apagar&id_conta=' . $conta['id_conta_pagar'] . '&id_empresa=' . $empresa['id_empresa'] . '"><img src="./../img/delete.png" alt="Apagar conta" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para excluir conta
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a href="#" onclick="editarConta(' . $conta['id_conta_pagar'] . ')"><img src="./../img/edit.png" alt="Editar conta" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para editar conta
                if (!$conta['pago']) {
                    echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a onclick="return confirm(\'Tem certeza que deseja mudar o status desta conta?\nO valor a ser pago será de R$' . comparaDataRetornaValor($conta['data_pagar'], $conta['valor']) . '.\')" href="./../../controller/contaController.php?action=atualizaStatus&id_conta_pagar=' . $conta['id_conta_pagar'] . '&valor=' . comparaDataRetornaValor($conta['data_pagar'], $conta['valor']) . '"><img src="./../img/waiting.png" alt="Marcar como paga" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para marcar como paga
                } else {
                    echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><img src="./../img/check.png" alt="Marcar como paga" width="25px" style="display: block; margin: 0 auto;"></td>'; // Exibe marca de paga se a conta estiver paga
                }
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
    }
}
?>
