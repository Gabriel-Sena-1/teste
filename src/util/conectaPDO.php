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



