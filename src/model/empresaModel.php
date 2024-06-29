<?php

// Tabela de tbl_empresa, 
// - id_empresa -> automaticamente preenchido no banco de dados
// - nome
require_once __DIR__.'./../util/conectaPDO.php';

class Empresa{
    public $nome;
}

function listarEmpresa(){
    $conn = conecta();

    try{
    $stmt = $conn->prepare('SELECT * FROM tbl_empresa');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $empresas = [];

    foreach ($result as $empresa) {
        $empresa['id_empresa'];
        $empresa['nome'];

        $empresas[] = $empresa;
    }
    return $empresas;
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
}  

function cadastraEmpresa($nome){
    $conn = conecta();
    try {
        $conn->beginTransaction();

        $sql = "INSERT INTO tbl_empresa(nome) VALUES (:nome)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        $conn->commit();

        return True;
    } catch(PDOException $e){
        $conn->rollBack();
        echo $e->getMessage();
        return False;
    }
}

function listarEmpresaConta(){
    $conn = conecta(); // Suponho que `conecta()` é uma função que retorna uma conexão PDO válida

    try {
        // Consulta para selecionar empresas e suas contas a pagar
        $query = 'SELECT e.id_empresa, e.nome AS nome_empresa, c.id_conta_pagar, c.valor, c.data_pagar, c.pago
                  FROM tbl_empresa e
                  LEFT JOIN tbl_conta_pagar c ON e.id_empresa = c.id_empresa
                  ORDER BY e.id_empresa';

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $empresas = [];

        // Iterar pelos resultados e estruturar o array de empresas
        foreach ($result as $row) {
            $id_empresa = $row['id_empresa'];
            $nome_empresa = $row['nome_empresa'];

            // Verificar se já adicionou a empresa ao array de empresas
            if (!isset($empresas[$id_empresa])) {
                $empresas[$id_empresa] = [
                    'id_empresa' => $id_empresa,
                    'nome' => $nome_empresa,
                    'contas' => []
                ];
            }

            // Adicionar informações da conta a pagar, se existirem
            if ($row['id_conta_pagar'] !== null) {
                $empresas[$id_empresa]['contas'][] = [
                    'id_conta_pagar' => $row['id_conta_pagar'],
                    'valor' => $row['valor'],
                    'data_pagar' => $row['data_pagar'],
                    'pago' => $row['pago']
                ];
            }
        }

        return $empresas;

    } catch (PDOException $e) {
        echo 'Erro ao listar empresas e contas: ' . $e->getMessage();
        return []; // Retornar um array vazio em caso de erro
    }
}
