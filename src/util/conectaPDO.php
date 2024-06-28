<?php

const servername = "localhost";
const username = "root";
const password = "";
const data_base_name = "teste-php";

function conecta()
{
    $conexao = null;
    try {
        $conexao = new PDO("mysql:host=" . servername . ";port=3306;dbname=" . data_base_name, username, password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Não foi possível conectar ao BD<br>';
        echo $e->getMessage();
    }

    return $conexao;
}

function createDB()
{
    $conn = conecta();

    try {
        $queryDB = "CREATE TABLE tbl_empresa (id_empresa INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(255) NOT NULL); CREATE TABLE tbl_conta_pagar (id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY, valor DECIMAL(10,2) NOT NULL, data_pagar DATE NOT NULL, pago TINYINT NOT NULL, id_empresa INT, FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa));";
        $stmt = $conn->prepare($queryDB);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br> Erro na função createDB";
    }
}
