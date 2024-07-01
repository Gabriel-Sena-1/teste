<?php

// Definição das constantes de conexão com o banco de dados
const servername = "localhost";
const username = "root";
const password = "";
const data_base_name = "teste-php";

// Função para realizar a conexão com o banco de dados usando PDO
function conecta()
{
    $conexao = null; // Inicializa a variável $conexao como nula

    try {
        // Tenta criar uma nova instância da classe PDO para conectar ao banco de dados MySQL
        $conexao = new PDO("mysql:host=" . servername . ";port=3306;dbname=" . data_base_name, username, password);

        // Define o modo de erro para PDO::ERRMODE_EXCEPTION, que faz com que o PDO lance exceções
        // sempre que ocorrer um erro, permitindo um tratamento adequado dos mesmos.
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Captura uma exceção do tipo PDOException caso a conexão não seja estabelecida
        echo 'Não foi possível conectar ao BD<br>'; // Mensagem de erro genérica
        echo $e->getMessage(); // Exibe a mensagem específica da exceção
    }

    return $conexao; // Retorna o objeto de conexão PDO, ou null em caso de erro
}

?>
