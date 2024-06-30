<?php

require_once __DIR__ . './../model/empresaModel.php';


if (!empty($_GET['action'])) {
    $action = $_GET['action'];
    echo $action;

    if (!empty($_GET['nome_empresa'])) {
        $nomeEmpresa = $_GET['nome_empresa'];
        $cadastrarEmpresa = cadastraEmpresa($nomeEmpresa);

        if ($cadastrarEmpresa) {
            $msg = "Empresa cadastrada com sucesso!!";
        } else {
            $msg = "Erro ao cadastrar empresa.";
        }
        header("Location: ./../view/pages/cadastrarEmpresa.php?msg=$msg");
        exit();
    }
}

function formatarData($data)
{
    $dataFormatada = date_create_from_format('Y-m-d', $data);
    return date_format($dataFormatada, 'd/m/Y');
}

function comparaDataRetornaValor($dataComparacao, $valor)
{
    $dataAtual = new DateTime();
    $dataComparacao = new DateTime($dataComparacao); // Converter para DateTime

    if ($dataAtual > $dataComparacao) {
        return $valor * 1.1;
    } elseif ($dataAtual < $dataComparacao) {
        return $valor * 0.95;
    } else {
        return $valor;
    }
}


function tableEmpresasContas()
{
    $empresasContas = listarEmpresaConta();
    foreach ($empresasContas as $empresa) {
        if (!empty($empresa['contas'])) {
            echo '<table class="tabelaEmpresas" style="width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 5px;" data-nome="' . htmlspecialchars($empresa['nome']) . '">';
            echo '<thead>';
            echo '<tr>';
            echo '<th colspan="6" style="background-color: #f2f2f2; text-align: center; padding: 10px; font-weight: bold;">' . htmlspecialchars($empresa['nome']) . '</th>'; // Nome da empresa
            echo '</tr>';
            echo '<tr>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">ID da Conta</th>';
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Valor</th>'; // Adicionando o título para o valor da conta
            echo '<th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Data de Pagamento</th>'; // Nova coluna para data de pagamento
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
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a onclick="return confirm(\'Tem certeza que deseja apagar esta conta?\')" href="./../../controller/contaController.php?action=apagar&id_conta=' . $conta['id_conta_pagar'] . '&id_empresa=' . $empresa['id_empresa'] . '"><img src="./../img/delete.png" alt="Apagar conta" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para excluir (substitua "#" pela URL real)
                echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a href="#" onclick="editarConta(' . $conta['id_conta_pagar'] . ')"><img src="./../img/edit.png" alt="Editar conta" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para editar (substitua "#" pela URL real)
                if (!$conta['pago']) {
                    echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><a onclick="return confirm(\'Tem certeza que deseja mudar o status desta conta?\nO valor a ser pago será de R$' . comparaDataRetornaValor($conta['data_pagar'], $conta['valor']) . '.\')" href="./../../controller/contaController.php?action=atualizaStatus&id_conta_pagar=' . $conta['id_conta_pagar'] . '&valor='.comparaDataRetornaValor($conta['data_pagar'], $conta['valor']).'"><img src="./../img/waiting.png" alt="Marcar como paga" width="25px" style="display: block; margin: 0 auto;"></a></td>'; // Link para marcar como paga (substitua "#" pela URL real)
                } else {
                    echo '<td style="border: 1px solid #ddd; padding: 10px; text-align: center;"><img src="./../img/check.png" alt="Marcar como paga" width="25px" style="display: block; margin: 0 auto;"></td>'; // Link para marcar como paga (substitua "#" pela URL real)
                }
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        }
    }
}
