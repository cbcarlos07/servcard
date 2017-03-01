<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class EstadoCivilDAO
{
     private $connection = null;

     public function insert (EstadoCivil $estadoCivil){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO estado_civil
                      (CD_ESTADO_CIVIL, DS_ESTADO_CIVIL) VALUES 
                      (NULL, :estado)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":estado", $estadoCivil->getDsEstadoCivil(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (EstadoCivil $estadoCivil){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE estado_civil SET 
                      DS_ESTADO_CIVIL = :estado
                      WHERE CD_ESTADO_CIVIL = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":estado", $estadoCivil->getDsEstadoCivil(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $estadoCivil->getCdEstadoCivil(), PDO::PARAM_INT);
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
            $query = "DELETE FROM estado_civil WHERE CD_ESTADO_CIVIL = :codigo";
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
        require_once ("services/EstadoCivilList.class.php");
        require_once ("beans/EstadoCivil.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $estadoCivilList = new EstadoCivilList();

        try {

                $sql = "SELECT *
                          FROM estado_civil E
                          WHERE E.DS_ESTADO_CIVIL LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $estadoCivil = new EstadoCivil();
                $estadoCivil->setCdEstadoCivil($row['CD_ESTADO_CIVIL']);
                $estadoCivil->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);
                $estadoCivilList->addEstadoCivil($estadoCivil);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estadoCivilList;
    }

    public function getLista($nome){
        require_once ("../services/EstadoCivilList.class.php");
        require_once ("../beans/EstadoCivil.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $estadoCivilList = new EstadoCivilList();

        try {

            $sql = "SELECT *
                          FROM estado_civil E
                          WHERE E.DS_ESTADO_CIVIL LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $estadoCivil = new EstadoCivil();
                $estadoCivil->setCdEstadoCivil($row['CD_ESTADO_CIVIL']);
                $estadoCivil->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);
                $estadoCivilList->addEstadoCivil($estadoCivil);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estadoCivilList;
    }

    public function getEstadoCivil($codigo){
        $estadoCivil = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM estado_civil WHERE CD_ESTADO_CIVIL = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $estadoCivil = new EstadoCivil();
                $estadoCivil->setCdEstadoCivil($row['CD_ESTADO_CIVIL']);
                $estadoCivil->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $estadoCivil;
    }
}