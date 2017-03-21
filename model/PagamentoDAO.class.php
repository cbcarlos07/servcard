<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class PagamentoDAO
{
     private $connection = null;

     public function insert (Pagamento $pagamento){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO pagamento 
                      (CD_PAGAMENTO, DT_PAGAMENTO, HR_PAGAMENTO, VL_PAGAMENTO, DT_VENCIMENTO, CD_CONTRATO) VALUES 
                      (NULL, curdate(), curtime(), :valor, :vencimento, :contrato)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":valor", $pagamento->getVlPagamento(), PDO::PARAM_STR);
             $stmt->bindValue(":vencimento", $pagamento->getDtVencimento(), PDO::PARAM_STR);
             $stmt->bindValue(":contrato", $pagamento->getContrato()->getCdContrato(), PDO::PARAM_INT);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Pagamento $pagamento){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE pagamento SET 
                      VL_PAGAMENTO  = :valor
                      WHERE CD_PAGAMENTO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":valor", $pagamento->getVlPagamento(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $pagamento->getCdPagamento(), PDO::PARAM_INT);
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
            $query = "DELETE FROM pagamento WHERE CD_PAGAMENTO = :codigo";
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

    public function getList($nome){
        require_once ("../services/PagamentoList.class.php");
        require_once ("../beans/Pagamento.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $pagamentoList = new PagamentoList();

        try {

                $sql = "SELECT *
                          FROM pagamento 
                          WHERE DT_VENCIMENTO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $pagamento = new Pagamento();
                $pagamento->setCdPagamento($row['CD_PAGAMENTO']);
                $pagamento->setDtPagamento($row['DT_PAGAMENTO']);
                $pagamento->setHrPagamento($row['HR_PAGAMENTO']);
                $pagamento->setVlPagamento($row['DT_PAGAMENTO']);
                $pagamento->setDtVencimento($row['DT_VENCIMENTO']);
                $pagamento->setContrato(new Contrato());
                $pagamento->getContrato()->setCdContrato($row['DT_PAGAMENTO']);
                $pagamentoList->addPagamento($pagamento);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $pagamentoList;
    }

    public function getPagamento($codigo){
        $pagamento = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM pagamento 
                          WHERE CD_PAGAMENTO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $pagamento = new Pagamento();
                $pagamento->setCdPagamento($row['CD_PAGAMENTO']);
                $pagamento->setDtPagamento($row['DT_PAGAMENTO']);
                $pagamento->setHrPagamento($row['HR_PAGAMENTO']);
                $pagamento->setVlPagamento($row['DT_PAGAMENTO']);
                $pagamento->setDtVencimento($row['DT_VENCIMENTO']);
                $pagamento->setContrato(new Contrato());
                $pagamento->getContrato()->setCdContrato($row['DT_PAGAMENTO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $pagamento;
    }
}