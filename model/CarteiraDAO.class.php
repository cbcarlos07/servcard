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
         $lastId = 0;
         try{
                 $query = "INSERT INTO carteira 
                           (CD_CARTEIRA, DT_VALIDADE, SN_ATIVO, 
                           TP_TITULAR, CD_CLIENTE, CD_PLANO, CD_CONTRATO) 
                           VALUES (
                           NULL, :validade, :ativo, :titular,
                            :cliente, :plano, :contrato
                           )";


             $stmt = $this->connection->prepare($query);
             $dataApp = explode('/',$carteira->getDtValidade());
             echo "Data validade: $dataApp[2]-$dataApp[1]-$dataApp[0] \n";
             echo "Cliente: ".$carteira->getCliente()->getCdCliente()." \n";
             $stmt->bindValue(":cliente", $carteira->getCliente()->getCdCliente(), PDO::PARAM_INT);
             $stmt->bindValue(":plano",$carteira->getPlano()->getCdPlano(), PDO::PARAM_INT);
             $stmt->bindValue(":validade","$dataApp[2]-$dataApp[1]-$dataApp[0]", PDO::PARAM_STR);
             $stmt->bindValue(":ativo", $carteira->getSnAtivo(), PDO::PARAM_STR);
             $stmt->bindValue(":titular", $carteira->getTpTitular(), PDO::PARAM_STR);
             $stmt->bindValue(":contrato", $carteira->getContrato()->getCdContrato(), PDO::PARAM_INT);
             $stmt->execute();
             $lastId = $this->connection->lastInsertId();
             $teste = true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         $this->inserir_nr_carteira($lastId);

         return $teste;
     }

     private function inserir_nr_carteira($codigo){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $carteira = "";
         echo "\n Codigo gerado: ".$codigo." \n";
         $count = strlen($codigo);
         echo "Numero de caractere: ".$count;

         for($i = 0;$i < (20 - $count); $i++){
                $carteira = $carteira . "0";
         }
        $carteira = $carteira . $codigo;
         echo "<br> ".$carteira."<br>";
         try{
             $query = "UPDATE carteira SET 
                           NR_CARTEIRA = :carteira 
                           WHERE CD_CARTEIRA = :codigo";


             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":carteira", $carteira, PDO::PARAM_STR);
             $stmt->bindValue(":codigo",   $codigo, PDO::PARAM_STR);

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

    public function getListByCarteira($cliente){
        require_once ("services/CarteiraList.class.php");
        require_once ("beans/Carteira.class.php");
        require_once ("beans/Contrato.class.php");
        require_once ("beans/Cliente.class.php");
        require_once ("beans/Plano.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $carteiraList = new CarteiraList();

        try {

                $sql = "SELECT * FROM carteira C
                        INNER JOIN cliente CLI ON C.CD_CLIENTE = CLI.CD_CLIENTE
                        INNER JOIN plano   P   ON C.CD_PLANO = P.CD_PLANO
                        WHERE C.CD_CLIENTE = :cliente
                        ORDER BY C.CD_CARTEIRA DESC";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cliente", $cliente, PDO::PARAM_INT);

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
                $carteira->setNrCarteira($row['NR_CARTEIRA']);
                $carteira->setContrato(new Contrato());
                $carteira->getContrato()->setCdContrato($row['CD_CONTRATO']);


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