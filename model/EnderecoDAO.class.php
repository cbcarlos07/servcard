<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class EnderecoDAO
{
     private $connection = null;

     public function insert (Endereco $endereco){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO endereco 
                       (DS_LOGRADOURO, CD_TP_LOGRADOURO, NR_CEP, CD_BAIRRO) 
                       VALUES 
                       (:logradouro, :tipo, :cep, :bairro)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":logradouro", $endereco->getDsLogradouro(), PDO::PARAM_STR);
             $stmt->bindValue(":tipo", $endereco->getTpLogradouro(), PDO::PARAM_STR);
             $stmt->bindValue(":cep", $endereco->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":bairro", $endereco->getBairro()->getCdBairro, PDO::PARAM_INT);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Endereco $endereco){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE endereco SET 
                        DS_LOGRADOURO = :logradouro, TP_LOGRADOURO = :tipo,  CD_BAIRRO = :bairro
                       WHERE 
                       NR_CEP = :cep";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":logradouro", $endereco->getDsLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue(":tipo", $endereco->getTpLogradouro(), PDO::PARAM_STR);
            $stmt->bindValue(":cep", $endereco->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $endereco->getBairro()->getCdBairro, PDO::PARAM_INT);
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
            $query = "DELETE FROM endereco WHERE NR_CEP = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_STR);
            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function getList($cep){
        require_once ("../services/EnderecoList.class.php");
        require_once ("../beans/Endereco.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $enderecoList = new EnderecoList();

        try {

                $sql = "SELECT * FROM endereco WHERE NR_CEP = :cep";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cep", "%$cep%", PDO::PARAM_STR);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro($row['TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $enderecoList->addEndereco($endereco);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $enderecoList;
    }

    public function getEndereco($cep){
        $endereco = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM endereco WHERE NR_CEP = :cep";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $cep, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $endereco = new Endereco();
                $endereco->setDsLogradouro($row['DS_LOGRADOURO']);
                $endereco->setTpLogradouro($row['TP_LOGRADOURO']);
                $endereco->setNrCep($row['NR_CEP']);
                $endereco->setBairro(new Bairro());
                $endereco->getBairro()->setCdBairro($row['CD_BAIRRO']);
                $endereco->getBairro()->setNmBairro($row['NM_BAIRRO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $endereco;
    }
}