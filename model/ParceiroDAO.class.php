<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ParceiroDAO
{
     private $connection = null;

     public function insert (Parceiro $parceiro){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO parceiro 
                      (CD_PARCEIRO, NM_PARCEIRO, DS_RESPONSAVEL, NR_CPF_RESPONSAVEL, NR_CNPJ, NR_CEP) VALUES 
                      (NULL, :parceiro, :responsavel, :cpf, :cnpj, :cep)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":parceiro", $parceiro->getNmParceiro(), PDO::PARAM_STR);
             $stmt->bindValue(":responsavel", $parceiro->getDsResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":cpf", $parceiro->getNrCpfResponsavel(), PDO::PARAM_STR);
             $stmt->bindValue(":cnpj", $parceiro->getNrCnpj(), PDO::PARAM_STR);
             $stmt->bindValue(":cep", $parceiro->getEndereco()->getNrCep(), PDO::PARAM_STR);
             $stmt->execute();

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
        try{
            $query = "UPDATE parceiro SET 
                      NM_PARCEIRO = :parceiro, DS_RESPONSAVEL = :responsavel
                      , NR_CPF_RESPONSAVEL = :cpf, NR_CNPJ = :cnpj, NR_CEP = :cep
                      WHERE CD_PARCEIRO = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":parceiro", $parceiro->getNmParceiro(), PDO::PARAM_STR);
            $stmt->bindValue(":responsavel", $parceiro->getDsResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $parceiro->getNrCpfResponsavel(), PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $parceiro->getNrCnpj(), PDO::PARAM_STR);
            $stmt->bindValue(":cep", $parceiro->getEndereco()->getNrCep());
            $stmt->bindValue(":codigo", $parceiro->getCdParceiro(), PDO::PARAM_INT);
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
            $query = "DELETE FROM parceiro WHERE CD_PARCEIRO = :codigo";
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
        require_once ("../services/ParceiroList.class.php");
        require_once ("../beans/Parceiro.class.php");

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
                $parceiro->setEndereco(new Endereco());
                $parceiro->getEndereco()->setNrCep($row['NR_CEP']);
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
                $parceiro->setEndereco(new Endereco());
                $parceiro->getEndereco()->setNrCep($row['NR_CEP']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $parceiro;
    }
}