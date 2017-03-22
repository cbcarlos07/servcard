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
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO contrato_mensal 
                       (CD_CONTRATO, DT_VENCIMENTO, NR_VALOR, NR_PARCELA, SN_PAGO) 
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
             $stmt->bindValue(":contrato", $contratoMensal->getContrato()->getCdContrato(), PDO::PARAM_INT);
             $stmt->bindValue(":vencimento", "$ano-$mes-$dia", PDO::PARAM_STR);
             $stmt->bindValue(":valor",$valor , PDO::PARAM_STR);
             $stmt->bindValue(":parcela", $contratoMensal->getNrParcela(), PDO::PARAM_INT);
             $stmt->bindValue(":status_", $contratoMensal->getSnPago(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
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
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE contrato_mensal SET 
                        DT_VENCIMENTO = :vencimento, NR_VALOR = :valor,
                        NR_PARCELA = :parcela, SN_PAGO =  :status_
                       WHERE 
                       CD_CONTRATO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":vencimento", $contratoMensal->getDtVencimento(), PDO::PARAM_STR);
            $stmt->bindValue(":valor", $contratoMensal->getNrValor(), PDO::PARAM_STR);
            $stmt->bindValue(":parcela", $contratoMensal->getNrParcela(), PDO::PARAM_INT);
            $stmt->bindValue(":status_", $contratoMensal->getSnPago(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $contratoMensal->getContrato()->getCdContrato(), PDO::PARAM_INT);
            $stmt->execute();
            $this->connection->commit();
            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function efetua_pagamento (ContratoMensal $contratoMensal){
        $this->connection =  null;
        $teste = false;
        //echo "Contrato".$contratoMensal->getContrato()->getCdContrato();
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE contrato_mensal SET 
                         SN_PAGO =  :status_
                       WHERE 
                           CD_CONTRATO = :codigo
                       AND NR_PARCELA  = :parcela";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":parcela", $contratoMensal->getNrParcela(), PDO::PARAM_INT);
            $stmt->bindValue(":status_", $contratoMensal->getSnPago(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo",  $contratoMensal->getContrato()->getCdContrato(), PDO::PARAM_INT);
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
            $query = "DELETE FROM contrato_mensal WHERE CD_CONTRATO = :codigo";
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

    public function getList($contrato){
        require_once ("../services/ContratoMensalList.class.php");
        require_once ("../beans/ContratoMensal.class.php");
        require_once ("../beans/Contrato.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contratoMensalList = new ContratoMensalList();

        try {

                $sql = "SELECT M.* FROM 
                        contrato_mensal M
                        INNER JOIN contrato C ON M.CD_CONTRATO = C.CD_CONTRATO
                        WHERE C.CD_CONTRATO = :contrato";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":contrato", $contrato, PDO::PARAM_INT);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contratoMensal = new ContratoMensal();
                $contratoMensal->setContrato(new Contrato());
                $contratoMensal->getContrato()->setCdContrato($row['CD_CONTRATO']);
                $contratoMensal->setDtVencimento($row['DT_VENCIMENTO']);
                $contratoMensal->setNrValor($row['NR_VALOR']);
                $contratoMensal->setNrParcela($row['NR_PARCELA']);
                $contratoMensal->setSnPago($row['SN_PAGO']);

                $contratoMensalList->addContratoMensal($contratoMensal);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoMensalList;
    }

    public function getLista($contrato){
        require_once ("services/ContratoMensalList.class.php");
        require_once ("beans/ContratoMensal.class.php");
        require_once ("beans/Contrato.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contratoMensalList = new ContratoMensalList();

        try {

            $sql = "SELECT M.* FROM 
                        contrato_mensal M
                        INNER JOIN contrato C ON M.CD_CONTRATO = C.CD_CONTRATO
                        WHERE C.CD_CONTRATO = :contrato";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":contrato", $contrato, PDO::PARAM_INT);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contratoMensal = new ContratoMensal();
                $contratoMensal->setContrato(new Contrato());
                $contratoMensal->getContrato()->setCdContrato($row['CD_CONTRATO']);
                $contratoMensal->setDtVencimento($row['DT_VENCIMENTO']);

                $contratoMensal->setNrParcela($row['NR_PARCELA']);
                //$contratoMensal->setNrParcela($row['NR_PARCELA']);
                $contratoMensal->setSnPago($row['SN_PAGO']);
                $pago = $row['SN_PAGO'];
                if($pago == 'S')
                    $contratoMensal->setNrValor($row['NR_VALOR']);
                else
                    $contratoMensal->setNrValor($this->getValorParcela($row['NR_VALOR'], $row['DT_VENCIMENTO']));
               // $contratoMensal->setSnPago($pago);

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
                $contratoMensal->setContrato(new Contrato());
                $contratoMensal->getContrato()->setCdContrato($row['CD_CONTRATO']);
                $contratoMensal->setDtVencimento($row['DT_VENCIMENTO']);
                $contratoMensal->setNrValor($row['NR_VALOR']);
                $contratoMensal->setNrParcela($row['NR_PARCELA']);
                $contratoMensal->setSnPago($row['SN_PAGO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoMensal;
    }

    private function getValorParcela($valor, $vencimento){
        $time_inicial = $this->geraTimestamp(date('d/m/Y'));
        $dataMySQL = explode('-', $vencimento);
        $time_final   = $this->geraTimestamp("$dataMySQL[2]/$dataMySQL[1]/$dataMySQL[0]");

        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

        $totalParcelas = 0;

        if($dias < 0){
            $auxDias       = -($dias);
            $totalParcelas = (($valor * $auxDias)/100) + $valor;
        }else{
            $totalParcelas = $valor;
        }
        return $totalParcelas;
    }

    // Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
  private  function geraTimestamp($data) {
        $partes = explode('/', $data);
        return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
    }


}