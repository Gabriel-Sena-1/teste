<?php

// Inclui o arquivo de conexão PDO
require_once __DIR__.'./../util/conectaPDO.php';

// Define a classe Empresa para representar os dados da tabela tbl_empresa
class Empresa {
    public $nome;
}

// Função para listar todas as empresas da tabela tbl_empresa
function listarEmpresa() {
    $conn = conecta(); // Conecta ao banco de dados usando a função conecta() definida no arquivo conectaPDO.php
    
    try {
        $stmt = $conn->prepare('SELECT * FROM tbl_empresa'); // Prepara a consulta SQL
        $stmt->execute(); // Executa a consulta
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém todas as linhas do resultado como um array associativo

        $empresas = [];

        // Itera sobre o resultado para construir o array de empresas
        foreach ($result as $empresa) {
            $empresas[] = $empresa; // Adiciona cada empresa ao array $empresas
        }

        return $empresas; // Retorna o array de empresas
    } catch (PDOException $e) {
        echo $e->getMessage(); // Captura e exibe qualquer exceção lançada durante a execução da consulta
    }
}

// Função para cadastrar uma nova empresa na tabela tbl_empresa
function cadastraEmpresa($nome) {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        $conn->beginTransaction(); // Inicia uma transação

        // Define o SQL para inserir uma nova empresa
        $sql = "INSERT INTO tbl_empresa(nome) VALUES (:nome)";
        $stmt = $conn->prepare($sql); // Prepara o statement com o SQL
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR); // Vincula o parâmetro :nome como string
        $stmt->execute(); // Executa o statement

        $conn->commit(); // Confirma a transação
        return true; // Retorna true indicando sucesso no cadastro da empresa
    } catch(PDOException $e) {
        $conn->rollBack(); // Reverte a transação em caso de exceção
        echo $e->getMessage(); // Exibe a mensagem de exceção
        return false; // Retorna false indicando falha no cadastro da empresa
    }
}

// Função para listar empresas e suas contas a pagar
function listarEmpresaConta() {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        // Consulta SQL para selecionar empresas e suas contas a pagar
        $query = 'SELECT e.id_empresa, e.nome AS nome_empresa, c.id_conta_pagar, c.valor, c.data_pagar, c.pago
                  FROM tbl_empresa e
                  LEFT JOIN tbl_conta_pagar c ON e.id_empresa = c.id_empresa
                  ORDER BY e.id_empresa';

        $stmt = $conn->prepare($query); // Prepara o statement com a consulta SQL
        $stmt->execute(); // Executa o statement
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém todas as linhas do resultado como um array associativo

        $empresas = [];

        // Itera sobre o resultado para estruturar o array de empresas e suas contas a pagar
        foreach ($result as $row) {
            $id_empresa = $row['id_empresa'];
            $nome_empresa = $row['nome_empresa'];

            // Verifica se a empresa já foi adicionada ao array de empresas
            if (!isset($empresas[$id_empresa])) {
                $empresas[$id_empresa] = [
                    'id_empresa' => $id_empresa,
                    'nome' => $nome_empresa,
                    'contas' => []
                ];
            }

            // Adiciona informações da conta a pagar, se existirem
            if ($row['id_conta_pagar'] !== null) {
                $empresas[$id_empresa]['contas'][] = [
                    'id_conta_pagar' => $row['id_conta_pagar'],
                    'valor' => $row['valor'],
                    'data_pagar' => $row['data_pagar'],
                    'pago' => $row['pago']
                ];
            }
        }

        return $empresas; // Retorna o array de empresas e suas contas a pagar
    } catch (PDOException $e) {
        echo 'Erro ao listar empresas e contas: ' . $e->getMessage(); // Exibe a mensagem de erro em caso de exceção
        return []; // Retorna um array vazio em caso de erro
    }
}

?>
