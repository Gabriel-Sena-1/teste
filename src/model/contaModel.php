<?php

// Tabela de tbl_conta_pagar
// - id_conta_pagar -> automaticamente inserido no banco de dados
// - valor DECIMAL(10,2)
// - data_pagar DATE
// - pago TINYINT
// - id_empresa
require_once __DIR__.'./../util/conectaPDO.php';

class Conta{
    public $valor;
    public $data_pagar;
    public $pago;
    public $id_empresa;
}
function listarContas(){
    $conn = conecta();
    
    try{
    $stmt = $conn->prepare('SELECT * FROM tbl_conta_pagar');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $empresas = [];

    foreach ($result as $conta) {
        $conta['id_conta_pagar'];
        $conta['valor'];
        $conta['data_pagar'];
        $conta['pago'];
        $conta['id_empresa'];

        $contas[] = $conta;
    }
    return $contas;
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
}  

function cadastraConta($valor, $data_pagar, $pago, $id_empresa){
    $conn = conecta();
    try {
        $conn->beginTransaction();

        $sql = "INSERT INTO tbl_conta_pagar(valor, data_pagar, pago, id_empresa) VALUES (:valor, :data_pagar, :pago, :id_empresa)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':data_pagar', $data_pagar, PDO::PARAM_STR);
        $stmt->bindValue(':pago', $pago, PDO::PARAM_BOOL);
        $stmt->bindValue(':id_empresa', $id_empresa, PDO::PARAM_INT);
        $stmt->execute();
        $conn->commit();

        return True;
    } catch(PDOException $e){
        $conn->rollBack();
        echo $e->getMessage();
        return False;
    }
}

function atualizaConta($id_conta_pagar, $valor, $data_pagar, $pago, $id_empresa) {
    $conn = conecta();
    try {
        $conn->beginTransaction();

        $sql = "UPDATE tbl_conta_pagar
                SET valor = :valor, data_pagar = :data_pagar, pago = :pago, id_empresa = :id_empresa
                WHERE id_conta_pagar = :id_conta_pagar";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':valor', $valor);
        $stmt->bindValue(':data_pagar', $data_pagar, PDO::PARAM_STR);
        $stmt->bindValue(':pago', $pago, PDO::PARAM_BOOL);
        $stmt->bindValue(':id_empresa', $id_empresa, PDO::PARAM_INT);
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT);
        $stmt->execute();
        
        $conn->commit();
        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo $e->getMessage();
        return false;
    }
}

function atualizaStatusConta($id_conta_pagar) {
    $conn = conecta();
    try {
        $conn->beginTransaction();

        $sql = "UPDATE tbl_conta_pagar
                SET pago = :pago
                WHERE id_conta_pagar = :id_conta_pagar";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':pago', 1);
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT);
        $stmt->execute();
        
        $conn->commit();
        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo $e->getMessage();
        return false;
    }
}

function deletaConta($id_conta_pagar, $id_empresa) {
    $conn = conecta();
    try {
        $conn->beginTransaction();

        $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar = :id_conta_pagar AND id_empresa = :id_empresa";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id_conta_pagar', $id_conta_pagar, PDO::PARAM_INT);
        $stmt->bindValue(':id_empresa', $id_empresa, PDO::PARAM_INT);
        $stmt->execute();
        
        $conn->commit();
        return true;
    } catch (PDOException $e) {
        $conn->rollBack();
        echo $e->getMessage();
        return false;
    }
}