<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ContaDAO
{
     private $connection = null;

     public function insert (Conta $conta){
         $this->connection =  null;
         $teste = false;

         if($conta->getSnAtual() == 'S'){
             $this->mudar_atual_nao();
         }
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO conta 
                       (CD_CONTA, NR_AGENCIA, NR_DIG_AGENCIA, NR_CONTA, NR_DIG_CONTA, NM_BANCO, SN_ATUAL, VL_TAXA_BOLETO, DS_SIGLA_BANCO) 
                       VALUES 
                       (NULL, :agencia, :digito, :conta, :digconta, :banco, :atual, :boleto, :sigla)";

             //echo "Dao: conta: ".$conta->getNmC;
             $stmt = $this->connection->prepare($query);

             $stmt->bindValue(":agencia", $conta->getNrAgencia(), PDO::PARAM_INT);
             $stmt->bindValue(":digito",  $conta->getNrDigAgencia(), PDO::PARAM_INT);
             $stmt->bindValue(":conta",   $conta->getNrConta(), PDO::PARAM_STR);
             $stmt->bindValue(":digconta",$conta->getNrDigConta(), PDO::PARAM_INT);
             $stmt->bindValue(":banco",   $conta->getNmBanco(), PDO::PARAM_STR);
             $stmt->bindValue(":atual",   $conta->getSnAtual(), PDO::PARAM_STR);
             $stmt->bindValue(":boleto", $conta->getVlTaxaBoleto(), PDO::PARAM_STR);
             $stmt->bindValue(":sigla",  $conta->getDsSiglaBanco(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function mudar_atual_nao (){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE conta SET 
                      SN_ATUAL         =  'N'";
            $stmt = $this->connection->prepare($query);

            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function mudar_atual ($codigo, $atual){
        $this->connection =  null;
        $teste = false;
        if($atual == 'S') {
            $this->mudar_atual_nao();
        }
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE conta SET 
                      SN_ATUAL         = :atual
                       WHERE CD_CONTA   = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":atual",   $atual);
            $stmt->bindValue(":codigo",  $codigo);
            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function update (Conta $conta){
        $this->connection =  null;
        $teste = false;
        if($conta->getSnAtual() == 'S'){
            $this->mudar_atual_nao();
        }
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE conta SET 
                       NR_AGENCIA       = :agencia
                      ,NR_DIG_AGENCIA   = :digito
                      ,NR_CONTA         = :conta
                      ,NR_DIG_CONTA     = :digconta
                      ,NM_BANCO         = :banco
                      ,SN_ATUAL         = :atual
                      ,VL_TAXA_BOLETO   = :boleto
                      ,DS_SIGLA_BANCO   = :sigla
                       WHERE CD_CONTA   = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":agencia", $conta->getNrAgencia(), PDO::PARAM_INT);
            $stmt->bindValue(":digito",  $conta->getNrDigAgencia(), PDO::PARAM_INT);
            $stmt->bindValue(":conta",   $conta->getNrConta(), PDO::PARAM_STR);
            $stmt->bindValue(":digconta",$conta->getNrDigConta(), PDO::PARAM_INT);
            $stmt->bindValue(":banco",   $conta->getNmBanco(), PDO::PARAM_STR);
            $stmt->bindValue(":atual",   $conta->getSnAtual(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo",  $conta->getCdConta(), PDO::PARAM_INT);
            $stmt->bindValue(":boleto",  $conta->getVlTaxaBoleto(), PDO::PARAM_STR);
            $stmt->bindValue(":sigla",   $conta->getDsSiglaBanco(), PDO::PARAM_STR);
            $stmt->execute();
            $this->connection->commit();
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
        $this->connection->beginTransaction();
        try{
            $query = "DELETE FROM conta WHERE CD_CONTA = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getListConta($nome){
        require_once ("services/ContaList.class.php");
        require_once ("beans/Conta.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contaList = new ContaList();

        try {

                $sql = "SELECT *
                        FROM conta B
                        WHERE B.NM_BANCO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $conta = new Conta();
                $conta->setCdConta($row['CD_CONTA']);
                $conta->setNrAgencia($row['NR_AGENCIA']);
                $conta->setNrDigAgencia($row['NR_DIG_AGENCIA']);
                $conta->setNrConta($row['NR_CONTA']);
                $conta->setNrDigConta($row['NR_DIG_CONTA']);
                $conta->setNmBanco($row['NM_BANCO']);
                $conta->setDsSiglaBanco($row['DS_SIGLA_BANCO']);
                $conta->setSnAtual($row['SN_ATUAL']);
                $conta->setVlTaxaBoleto($row['VL_TAXA_BOLETO']);
                $contaList->addConta($conta);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contaList;
    }

    public function getListaConta($nome, $cidade){
        require_once ("../services/ContaList.class.php");
        require_once("../beans/Conta.class.php");
        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contaList = new ContaList();

        try {

            $sql = "SELECT *
                        FROM conta B
                        WHERE B.NM_BANCO LIKE :nome";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            $stmt->bindValue(":cidade",$cidade, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $conta = new Conta();
                $conta->setCdConta($row['CD_CONTA']);
                $conta->setNrAgencia($row['NR_AGENCIA']);
                $conta->setNrDigAgencia($row['NR_DIG_AGENCIA']);
                $conta->setNrConta($row['NR_CONTA']);
                $conta->setNrDigConta($row['NR_DIG_CONTA']);
                $conta->setNmBanco($row['NM_BANCO']);
                $conta->setDsSiglaBanco($row['DS_SIGLA_BANCO']);
                $conta->setSnAtual($row['SN_ATUAL']);
                $conta->setVlTaxaBoleto($row['VL_TAXA_BOLETO']);

                $contaList->addConta($conta);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contaList;
    }

    public function getConta($codigo){
        $conta = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM conta
                    WHERE CD_CONTA = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $conta = new Conta();
                $conta->setCdConta($row['CD_CONTA']);
                $conta->setNrAgencia($row['NR_AGENCIA']);
                $conta->setNrDigAgencia($row['NR_DIG_AGENCIA']);
                $conta->setNrConta($row['NR_CONTA']);
                $conta->setNrDigConta($row['NR_DIG_CONTA']);
                $conta->setNmBanco($row['NM_BANCO']);
                $conta->setDsSiglaBanco($row['DS_SIGLA_BANCO']);
                $conta->setSnAtual($row['SN_ATUAL']);
                $conta->setVlTaxaBoleto($row['VL_TAXA_BOLETO']);

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $conta;
    }


    public function getContaAtual(){
        $conta = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM conta
                    WHERE SN_ATUAL = 'S'";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $conta = new Conta();
                $conta->setCdConta($row['CD_CONTA']);
                $conta->setNrAgencia($row['NR_AGENCIA']);
                $conta->setNrDigAgencia($row['NR_DIG_AGENCIA']);
                $conta->setNrConta($row['NR_CONTA']);
                $conta->setNrDigConta($row['NR_DIG_CONTA']);
                $conta->setNmBanco($row['NM_BANCO']);
                $conta->setDsSiglaBanco($row['DS_SIGLA_BANCO']);
                $conta->setSnAtual($row['SN_ATUAL']);
                $conta->setVlTaxaBoleto($row['VL_TAXA_BOLETO']);

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $conta;
    }



    public function getContaTotal(){

        $conta = 0;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT COUNT(*) TOTAL FROM conta
                    WHERE SN_ATUAL = 'S'";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $conta = $row['TOTAL'];

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $conta;
    }


}