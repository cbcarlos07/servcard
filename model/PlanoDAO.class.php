<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class PlanoDAO
{
     private $connection = null;

     public function insert (Plano $plano){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO plano 
                      (CD_PLANO, DS_PLANO, OBS_PLANO, NR_VALOR) VALUES 
                      (NULL, :plano, :obs, :valor)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":plano", $plano->getDsPlano(), PDO::PARAM_STR);
             $stmt->bindValue(":obs", $plano->getObsPlano(), PDO::PARAM_STR);
             $stmt->bindValue(":valor", $plano->getNrValor(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Plano $plano){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE plano SET 
                      DS_PLANO = :plano, OBS_PLANO = :obs, NR_VALOR = :valor
                      WHERE CD_PLANO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":plano", $plano->getDsPlano(), PDO::PARAM_STR);
            $stmt->bindValue(":obs", $plano->getObsPlano(), PDO::PARAM_STR);
            $stmt->bindValue(":valor", $plano->getNrValor(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $plano->getCdPlano(), PDO::PARAM_INT);
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
            $query = "DELETE FROM plano WHERE CD_PLANO = :codigo";
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
        require_once ("services/PlanoList.class.php");
        require_once ("beans/Plano.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $planoList = new PlanoList();

        try {

                $sql = "SELECT *
                          FROM plano E
                          WHERE E.DS_PLANO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $plano = new Plano();
                $plano->setCdPlano($row['CD_PLANO']);
                $plano->setDsPlano($row['DS_PLANO']);
                $plano->setObsPlano($row['OBS_PLANO']);
                $plano->setNrValor($row['NR_VALOR']);
                $planoList->addPlano($plano);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $planoList;
    }

    public function getPlano($codigo){
        $plano = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM plano E
                          WHERE E.CD_PLANO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $plano = new Plano();
                $plano->setCdPlano($row['CD_PLANO']);
                $plano->setDsPlano($row['DS_PLANO']);
                $plano->setObsPlano($row['OBS_PLANO']);
                $plano->setNrValor($row['NR_VALOR']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $plano;
    }
}