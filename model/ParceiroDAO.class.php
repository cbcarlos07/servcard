<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
//include "../include/error.php";
include_once ("ConnectionFactory.class.php");

class ParceiroDAO
{
     private $connection = null;

     public function insert (Parceiro $parceiro){

         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO parceiro 
                      (CD_PARCEIRO, NM_PARCEIRO, DS_RESPONSAVEL, NR_CPF_RESPONSAVEL, 
                      NR_CNPJ, NR_CEP, CD_BAIRRO, DS_RAMO
                      ,NR_CASA, DS_COMPLEMENTO) VALUES 
                      (NULL, :parceiro, :responsavel, :cpf, :cnpj,
                       :cep, :bairro, :ramo, :numero, :complemento)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":parceiro", $parceiro->getNmParceiro(), PDO::PARAM_STR);
             $stmt->bindValue(":responsavel", $parceiro->getDsResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":cpf", $parceiro->getNrCpfResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":cnpj", $parceiro->getNrCnpj(), PDO::PARAM_STR);
             $stmt->bindValue(":cep", $parceiro->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":bairro", $parceiro->getBairro()->getCdBairro(), PDO::PARAM_INT);
             $stmt->bindValue(":ramo", $parceiro->getDsRamo(), PDO::PARAM_STR);
             $stmt->bindValue(":numero", $parceiro->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento", $parceiro->getDsComplemento(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();
             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Parceiro $parceiro){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE parceiro SET 
                      NM_PARCEIRO = :parceiro, DS_RESPONSAVEL = :responsavel
                      , NR_CPF_RESPONSAVEL = :cpf, NR_CNPJ = :cnpj, NR_CEP = :cep, CD_BAIRRO = :bairro,
                      DS_RAMO = :ramo, NR_CASA = :numero, DS_COMPLEMENTO = :complemento
                      WHERE CD_PARCEIRO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":parceiro", $parceiro->getNmParceiro(), PDO::PARAM_STR);
            $stmt->bindValue(":responsavel", $parceiro->getDsResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $parceiro->getNrCpfResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $parceiro->getNrCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":cep", $parceiro->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $parceiro->getBairro()->getCdBairro(), PDO::PARAM_INT);
            $stmt->bindValue(":ramo", $parceiro->getDsRamo(), PDO::PARAM_STR);
            $stmt->bindValue(":codigo", $parceiro->getCdParceiro(), PDO::PARAM_INT);
            $stmt->bindValue(":numero", $parceiro->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento", $parceiro->getDsComplemento(), PDO::PARAM_STR);
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
            $query = "DELETE FROM parceiro WHERE CD_PARCEIRO = :codigo";
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
        require_once ("services/ParceiroList.class.php");
        require_once ("beans/Parceiro.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $parceiroList = new ParceiroList();

        try {

                $sql = "SELECT *
                          FROM parceiro 
                          WHERE NM_PARCEIRO LIKE :nome";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $parceiro = new Parceiro();
                $parceiro->setCdParceiro($row['CD_PARCEIRO']);
                $parceiro->setNmParceiro($row['NM_PARCEIRO']); //NOME DA EMPRESA
                $parceiro->setDsResponsavel($row['DS_RESPONSAVEL']); //NOME DO RESPONSAVEL PELA EMPRESA
                $parceiro->setNrCpfResponsavel($row['NR_CPF_RESPONSAVEL']);
                $parceiro->setNrCnpj($row['NR_CNPJ']);
                $parceiro->setDsRamo($row['DS_RAMO']);
                $parceiroList->addParceiro($parceiro);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $parceiroList;
    }

    public function getParceiro($codigo){
        $parceiro = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT *
                          FROM parceiro 
                          WHERE CD_PARCEIRO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $parceiro = new Parceiro();
                $parceiro->setCdParceiro($row['CD_PARCEIRO']);
                $parceiro->setNmParceiro($row['NM_PARCEIRO']); //NOME DA EMPRESA
                $parceiro->setDsResponsavel($row['DS_RESPONSAVEL']); //NOME DO RESPONSAVEL PELA EMPRESA
                $parceiro->setNrCpfResponsavel($row['NR_CPF_RESPONSAVEL']);
                $parceiro->setNrCnpj($row['NR_CNPJ']);
                $parceiro->setNrCep($row['NR_CEP']);
                $parceiro->setNrCasa($row['NR_CASA']);
                $parceiro->setDsComplemento($row['DS_COMPLEMENTO']);
                $parceiro->setDsRamo($row['DS_RAMO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $parceiro;
    }
}