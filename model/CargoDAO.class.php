<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class CargoDAO
{
     private $connection = null;

     public function insert (Cargo $cargo){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "CALL PROC_CARGO(NULL, :cargo, :obs, 'I');";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cargo", $cargo->getDsCargo(), PDO::PARAM_STR);
             $stmt->bindValue(":obs",$cargo->getObsCargo(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Cargo $cargo){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "CALL PROC_CARGO(:codigo, :cargo, :obs, 'A');";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":cargo", $cargo->getDsCargo(), PDO::PARAM_STR);
            $stmt->bindValue(":obs",$cargo->getObsCargo(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $cargo->getCdCargo());
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
            $query = "CALL PROC_CARGO(:codigo, NULL, NULL, 'E');";
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

    public function getListByCargo($nome){
        require_once ("services/CargoList.class.php");
        require_once ("beans/Cargo.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $cargoList = new CargoList();

        try {

                $sql = "CALL PROC_CARGO(NULL, :cargo, NULL, 'N');";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cargo", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cargo = new Cargo();
                $cargo->setCdCargo($row['CD_CARGO']);
                $cargo->setDsCargo($row['DS_CARGO']);
                $cargo->setObsCargo($row['OBS_CARGO']);

                $cargoList->addCargo($cargo);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cargoList;
    }

    public function getListaByCargo($nome){
        require_once ("../services/CargoList.class.php");
        require_once ("../beans/Cargo.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $cargoList = new CargoList();

        try {

            $sql = "SELECT * FROM cargo";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cargo", $nome, PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cargo = new Cargo();
                $cargo->setCdCargo($row['CD_CARGO']);
                $cargo->setDsCargo($row['DS_CARGO']);
                $cargo->setObsCargo($row['OBS_CARGO']);

                $cargoList->addCargo($cargo);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cargoList;
    }



    public function getCargo($codigo){
        $cargo = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "CALL PROC_CARGO(:codigo, NULL, NULL, 'C');";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cargo = new Cargo();
                $cargo->setCdCargo($row['CD_CARGO']);
                $cargo->setDsCargo($row['DS_CARGO']);
                $cargo->setObsCargo($row['OBS_CARGO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cargo;
    }
}