<?php

// Inclui o arquivo que contém a função `conecta()`, responsável por estabelecer a conexão PDO
require_once __DIR__ . '/conectaPDO.php';

// Função para criar as tabelas no banco de dados
function createDB()
{
    $conn = conecta(); // Estabelece a conexão com o banco de dados usando a função `conecta()`

    try {
        // Query SQL para criar as tabelas `tbl_empresa` e `tbl_conta_pagar`
        $queryDB = "CREATE TABLE tbl_empresa (id_empresa INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(255) NOT NULL); CREATE TABLE tbl_conta_pagar (id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY, valor DECIMAL(10,2) NOT NULL, data_pagar DATE NOT NULL, pago TINYINT NOT NULL, id_empresa INT, FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa));";
        // Prepara a query SQL para execução
        $stmt = $conn->prepare($queryDB);

        // Executa a query SQL e retorna true se a execução foi bem-sucedida
        return $stmt->execute();
    } catch (PDOException $e) {
        // Captura uma exceção do tipo PDOException caso ocorra um erro na execução da query
        echo $e->getMessage(); // Exibe a mensagem específica da exceção
        echo "<br> Erro na função createDB"; // Mensagem de erro genérica
        return false; // Retorna false indicando que houve um erro na execução
    }
}
