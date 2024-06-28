<?php

// Tabela de tbl_empresa, 
// - id_empresa
// - nome

class Empresa{
    public $nome;

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

}