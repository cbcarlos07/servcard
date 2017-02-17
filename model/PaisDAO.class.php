<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class PaisDAO
{
     private $connection = null;

     public function insert (Pais $pais){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO `pais` VALUES (:pais)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":pais", $pais->getDsPais(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Pais $pais){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE `pais SET `DS_PAIS`` = :pais WHERE `CD_PAIS` = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":pais", $pais->getDsPais(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $pais->getCdPais(), PDO::PARAM_INT);
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
            $query = "DELETE FROM `pais` WHERE `CD_PAIS` = :codigo";
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
        require_once ("services/PaisList.class.php");
        require_once ("beans/Pais.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $paisList = new PaisList();

        try {
            if($nome == ""){
                $sql = "SELECT * FROM `pais`";
                $stmt = $this->conexao->prepare($sql);
            }else{
                $sql = "SELECT * FROM `pais` WHERE `DS_PAIS` LIKE :nome";
                $stmt = $this->conexao->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pais = new Pais();
                $pais->setCdPais($row['CD_PAIS']);
                $pais->setDsPais($row['DS_PAIS']);

                $paisList->addPais($pais);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $paisList;
    }

    public function getPais($codigo){
        $pais = null;
        $conexao = null;
        $this->conexao =  new ConnectionFactory();
        $sql = "SELECT * FROM `pais` WHERE `CD_PAIS` = :codigo";

        try {
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $pais = new Pais();
                $pais->setCdPais($row['CD_PAIS']);
                $pais->setDsPais($row['DS_PAIS']);
            }
            $this->conexao = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $pais;
    }
}