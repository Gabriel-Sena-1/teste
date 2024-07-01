<?php

// Inclui o arquivo de conexão PDO
require_once __DIR__.'./../util/conectaPDO.php';

// Define a classe Conta para representar os dados da tabela tbl_conta_pagar
class Conta {
    public $valor;
    public $data_pagar;
    public $pago;
    public $id_empresa;
}

// Função para listar todas as contas da tabela tbl_conta_pagar
function listarContas() {
    $conn = conecta(); // Conecta ao banco de dados usando a função conecta() definida no arquivo conectaPDO.php
    
    try {
        $stmt = $conn->prepare('SELECT * FROM tbl_conta_pagar'); // Prepara a consulta SQL
        $stmt->execute(); // Executa a consulta
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtém todas as linhas do resultado como um array associativo

        $contas = [];

        // Itera sobre o resultado para construir o array de contas
        foreach ($result as $conta) {
            $contas[] = $conta; // Adiciona cada conta ao array $contas
        }

        return $contas; // Retorna o array de contas
    } catch (PDOException $e) {
        echo $e->getMessage(); // Captura e exibe qualquer exceção lançada durante a execução da consulta
    }
}

// Função para cadastrar uma nova conta na tabela tbl_conta_pagar
function cadastraConta($valor, $data_pagar, $pago, $id_empresa) {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        $conn->beginTransaction(); // Inicia uma transação

        // Define o SQL para inserir uma nova conta
        $sql = "INSERT INTO tbl_conta_pagar(valor, data_pagar, pago, id_empresa) VALUES (:valor, :data_pagar, :pago, :id_empresa)";
        $stmt = $conn->prepare($sql); // Prepara o statement com o SQL
        $stmt->bindValue(':valor', $valor); // Vincula o parâmetro :valor
        $stmt->bindValue(':data_pagar', $data_pagar, PDO::PARAM_STR); // Vincula o parâmetro :data_pagar como string
        $stmt->bindValue(':pago', $pago, PDO::PARAM_BOOL); // Vincula o parâmetro :pago como booleano
        $stmt->bindValue(':id_empresa', $id_empresa, PDO::PARAM_INT); // Vincula o parâmetro :id_empresa como inteiro
        $stmt->execute(); // Executa o statement

        $conn->commit(); // Confirma a transação
        return true; // Retorna true indicando sucesso no cadastro da conta
    } catch(PDOException $e) {
        $conn->rollBack(); // Reverte a transação em caso de exceção
        echo $e->getMessage(); // Exibe a mensagem de exceção
        return false; // Retorna false indicando falha no cadastro da conta
    }
}

// Função para atualizar uma conta na tabela tbl_conta_pagar
function atualizaConta($id_conta_pagar, $valor, $data_pagar) {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        $conn->beginTransaction(); // Inicia uma transação

        // Define o SQL para atualizar uma conta existente
        $sql = "UPDATE tbl_conta_pagar SET valor = :valor, data_pagar = :data_pagar WHERE id_conta_pagar = :id_conta_pagar";
        $stmt = $conn->prepare($sql); // Prepara o statement com o SQL
        $stmt->bindValue(':valor', $valor); // Vincula o parâmetro :valor
        $stmt->bindValue(':data_pagar', $data_pagar, PDO::PARAM_STR); // Vincula o parâmetro :data_pagar como string
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT); // Vincula o parâmetro :id_conta_pagar como inteiro
        $stmt->execute(); // Executa o statement

        $conn->commit(); // Confirma a transação
        return true; // Retorna true indicando sucesso na atualização da conta
    } catch (PDOException $e) {
        $conn->rollBack(); // Reverte a transação em caso de exceção
        echo $e->getMessage(); // Exibe a mensagem de exceção
        return false; // Retorna false indicando falha na atualização da conta
    }
}

// Função para atualizar o status de pagamento de uma conta na tabela tbl_conta_pagar
function atualizaStatusConta($id_conta_pagar, $valor) {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        $conn->beginTransaction(); // Inicia uma transação

        // Define o SQL para atualizar o status de pagamento de uma conta
        $sql = "UPDATE tbl_conta_pagar SET pago = :pago, valor = :valor WHERE id_conta_pagar = :id_conta_pagar";
        $stmt = $conn->prepare($sql); // Prepara o statement com o SQL
        $stmt->bindValue(':pago', 1); // Vincula o parâmetro :pago como 1 (indicando pago)
        $stmt->bindValue(':valor', $valor); // Vincula o parâmetro :valor
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT); // Vincula o parâmetro :id_conta_pagar como inteiro
        $stmt->execute(); // Executa o statement

        $conn->commit(); // Confirma a transação
        return true; // Retorna true indicando sucesso na atualização do status da conta
    } catch (PDOException $e) {
        $conn->rollBack(); // Reverte a transação em caso de exceção
        echo $e->getMessage(); // Exibe a mensagem de exceção
        return false; // Retorna false indicando falha na atualização do status da conta
    }
}

// Função para deletar uma conta da tabela tbl_conta_pagar
function deletaConta($id_conta_pagar, $id_empresa) {
    $conn = conecta(); // Conecta ao banco de dados

    try {
        $conn->beginTransaction(); // Inicia uma transação

        // Define o SQL para deletar uma conta específica
        $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar = :id_conta_pagar AND id_empresa = :id_empresa";
        $stmt = $conn->prepare($sql); // Prepara o statement com o SQL
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT); // Vincula o parâmetro :id_conta_pagar como inteiro
        $stmt->bindValue(':id_empresa', $id_empresa, PDO::PARAM_INT); // Vincula o parâmetro :id_empresa como inteiro
        $stmt->execute(); // Executa o statement

        $conn->commit(); // Confirma a transação
        return true; // Retorna true indicando sucesso na exclusão da conta
    } catch (PDOException $e) {
        $conn->rollBack(); // Reverte a transação em caso de exceção
        echo $e->getMessage(); // Exibe a mensagem de exceção
        return false; // Retorna false indicando falha na exclusão da conta
    }
}

?>
