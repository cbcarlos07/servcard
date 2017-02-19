<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class CarteiraDAO
{
     private $connection = null;

     public function insert (Carteira $carteira){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
                 $query = "{CALL PROC_CARTEIRA(NULL, :cliente, :plano, :validade, :ativo, 
                            :titular, :carteira, 'I')}";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":cliente", $carteira->getCliente()->getCdCliente(), PDO::PARAM_INT);
             $stmt->bindValue(":plano",$carteira->getPlano()->getCdPlano(), PDO::PARAM_INT);
             $stmt->bindValue(":validade",$carteira->getDtValidade(), PDO::PARAM_STR);
             $stmt->bindValue(":ativo", $carteira->getSnAtivo(), PDO::PARAM_STR);
             $stmt->bindValue(":titular", $carteira->getTpTitular(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Carteira $carteira){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "{CALL PROC_CARTEIRA(:codigo, :cliente, :plano, :validade, :ativo, 
                            :titular, :carteira, 'A')}";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $carteira->getCdCarteira(), PDO::PARAM_INT);
            $stmt->bindValue(":cliente", $carteira->getCliente()->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":plano",$carteira->getPlano()->getCdPlano(), PDO::PARAM_INT);
            $stmt->bindValue(":validade",$carteira->getDtValidade(), PDO::PARAM_STR);
            $stmt->bindValue(":ativo", $carteira->getSnAtivo(), PDO::PARAM_STR);
            $stmt->bindValue(":titular", $carteira->getTpTitular(), PDO::PARAM_STR);
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
            $query = "{CALL PROC_CARTEIRA(:codigo, NULL, NULL, NULL, NULL, 
                            NULL, NULL, 'E')}";
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

    public function getListByCarteira($nome){
        require_once ("../services/CarteiraList.class.php");
        require_once ("../beans/Carteira.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $carteiraList = new CarteiraList();

        try {

                $sql = "{CALL PROC_CARTEIRA(NULL, NULL, NULL, NULL, NULL, 
                            NULL, NULL, 'T')}";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = new Carteira();
                $carteira->setCdCarteira($row['CD_CARTEIRA']);
                $carteira->setCliente(new Cliente());
                $carteira->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $carteira->getCliente()->setNmCliente($row['NM_CLIENTE']);
                $carteira->setPlano(new Plano());
                $carteira->getPlano()->setCdPlano($row['CD_PLANO']);
                $carteira->getPlano()->setDsPlano($row['DS_PLANO']);
                $carteira->setSnAtivo($row['SN_ATIVO']);
                $carteira->setTpTitular($row['TP_TITULAR']);
                $carteira->setDtValidade($row['DT_VALIDADE']);


                $carteiraList->addCarteira($carteira);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteiraList;
    }


    public function getCarteira($codigo){
        $carteira = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "{CALL PROC_CARTEIRA(:codigo, NULL, NULL, NULL, NULL, 
                            NULL, NULL, 'C')}";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = new Carteira();
                $carteira->setCdCarteira($row['CD_CARTEIRA']);
                $carteira->setCliente(new Cliente());
                $carteira->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $carteira->getCliente()->setNmCliente($row['NM_CLIENTE']);
                $carteira->setPlano(new Plano());
                $carteira->getPlano()->setCdPlano($row['CD_PLANO']);
                $carteira->getPlano()->setDsPlano($row['DS_PLANO']);
                $carteira->setSnAtivo($row['SN_ATIVO']);
                $carteira->setTpTitular($row['TP_TITULAR']);
                $carteira->setDtValidade($row['DT_VALIDADE']);

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteira;
    }
}