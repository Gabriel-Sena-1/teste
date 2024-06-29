<?php

require_once __DIR__ . '/conectaPDO.php';

function createDB()
{
    $conn = conecta();

    try {
        $queryDB = "CREATE TABLE tbl_empresa (id_empresa INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(255) NOT NULL); CREATE TABLE tbl_conta_pagar (id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY, valor DECIMAL(10,2) NOT NULL, data_pagar DATE NOT NULL, pago TINYINT NOT NULL, id_empresa INT, FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa));";
        $stmt = $conn->prepare($queryDB);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "<br> Erro na função createDB";
        return false;
    }
}

$criarDB = createDB();

if($criarDB){
    echo 'Banco criado com sucesso!';
    header('Location: ./../pages/home.php?setdb=1');
}else{
    header('./../view/pages/home.php');
}