<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class CidadeDAO
{
     private $connection = null;

     public function insert (Cidade $cidade){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "{CALL PROC_PAIS(NULL, :cidade, 'I')}";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cidade", $cidade->getDsCidade(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Cidade $cidade){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "{CALL PROC_PAIS(:codigo, :cidade, 'A')}";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":cidade", $cidade->getDsCidade(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $cidade->getCdCidade(), PDO::PARAM_INT);
            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function delete ($codigo){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "{CALL PROC_PAIS(:codigo, NULL, 'E')}";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getList($nome){
        require_once ("../services/CidadeList.class.php");
        require_once ("../beans/Cidade.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $cidadeList = new CidadeList();

        try {
            if($nome == ""){
                $sql = "{CALL PROC_PAIS(NULL, NULL, 'I')}";
                $stmt = $this->connection->prepare($sql);
            }else{
                $sql = "{CALL PROC_PAIS(NULL, :nome, 'N')}";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cidade = new Cidade();
                $cidade->setCdCidade($row['CD_PAIS']);
                $cidade->setDsCidade($row['DS_PAIS']);

                $cidadeList->addCidade($cidade);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cidadeList;
    }

    public function getCidade($codigo){
        $cidade = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "{CALL PROC_PAIS(:codigo, NULL, 'C')}";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cidade = new Cidade();
                $cidade->setCdCidade($row['CD_PAIS']);
                $cidade->setDsCidade($row['DS_PAIS']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cidade;
    }
}