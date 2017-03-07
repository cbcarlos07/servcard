<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ContratoMensalDAO
{
     private $connection = null;

     public function insert (ContratoMensal $contratoMensal){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO contrato_mensal 
                       (CD_CONTRATO, DT_VENCIMENTO, NR_VALOR, NR_PARCELA, TP_STATUS) 
                       VALUES 
                       (:contrato, :vencimento, :valor, :parcela, :status_)";

             $stmt = $this->connection->prepare($query);
             $dataArray = explode('/',$contratoMensal->getDtVencimento());
             $dia = $dataArray[0];
             $mes = $dataArray[1];
             $ano = $dataArray[2];
             //echo "Data: $ano-$mes-$dia <br>";

             $valor = str_replace("R$ ", '',$contratoMensal->getNrValor());
             $valor = str_replace(",",".",$valor);
             //echo "Valor: $valor <br>";
             $stmt->bindValue(":contrato", $contratoMensal->getCdContrato(), PDO::PARAM_INT);
             $stmt->bindValue(":vencimento", "$ano-$mes-$dia", PDO::PARAM_STR);
             $stmt->bindValue(":valor",$valor , PDO::PARAM_STR);
             $stmt->bindValue(":parcela", $contratoMensal->getNrParcela(), PDO::PARAM_INT);
             $stmt->bindValue(":status_", $contratoMensal->getTpStatus(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (ContratoMensal $contratoMensal){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE contrato_mensal SET 
                        DT_VENCIMENTO = :vencimento, NR_VALOR = :valor,
                        NR_PARCELA = :parcela, TP_STATUS =  :status_
                       WHERE 
                       CD_CONTRATO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":vencimento", $contratoMensal->getDtVencimento(), PDO::PARAM_STR);
            $stmt->bindValue(":valor", $contratoMensal->getNrValor(), PDO::PARAM_STR);
            $stmt->bindValue(":parcela", $contratoMensal->getNrParcela(), PDO::PARAM_INT);
            $stmt->bindValue(":status_", $contratoMensal->getTpStatus(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $contratoMensal->getCdContrato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM contrato_mensal WHERE CD_CONTRATO = :codigo";
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

    public function getList(){
        require_once ("../services/ContratoMensalList.class.php");
        require_once ("../beans/ContratoMensal.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contratoMensalList = new ContratoMensalList();

        try {

                $sql = "SELECT * FROM contrato_mensal";
                $stmt = $this->connection->prepare($sql);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contratoMensal = new ContratoMensal();
                $contratoMensal->setCdContrato($row['CD_CONTRATO']);
                $contratoMensal->setDtVencimento($row['DT_VENCIMENTO']);
                $contratoMensal->setNrValor($row['NR_VALOR']);
                $contratoMensal->setNrParcela($row['NR_PARCELA']);
                $contratoMensal->setTpStatus($row['TP_STATUS']);

                $contratoMensalList->addContratoMensal($contratoMensal);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoMensalList;
    }

    public function getContratoMensal($codigo){
        $contratoMensal = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM contrato_mensal WHERE CD_CONTRATO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $contratoMensal = new ContratoMensal();
                $contratoMensal->setCdContrato($row['CD_CONTRATO']);
                $contratoMensal->setDtVencimento($row['DT_VENCIMENTO']);
                $contratoMensal->setNrValor($row['NR_VALOR']);
                $contratoMensal->setNrParcela($row['NR_PARCELA']);
                $contratoMensal->setTpStatus($row['TP_STATUS']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoMensal;
    }
}