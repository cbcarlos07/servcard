<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ClienteDAO
{
     private $connection = null;

     public function insert (Cliente $cliente){
         $this->connection =  null;
         $teste = false;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO `cliente`
                       (`CD_CLIENTE`, `NM_CLIENTE`, `NR_CPF`, `NR_RG`, `NR_TELEFONE`, 
                       `DS_EMAIL`, `DT_NASCIMENTO`, `TP_SEXO`, `CD_ESTADO_CIVIL`, 
                       `NR_CEP`, `DS_SENHA`) 
                       VALUES 
                       (NULL, :nome, :cpf, :rg, :telefone, :email, :nascimento, :sexo, :ec, :cep, MD5(:senha))";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":nome", $cliente->getNmCliente(), PDO::PARAM_STR);
             $stmt->bindValue(":cpf", $cliente->getNrCpf(), PDO::PARAM_STR);
             $stmt->bindValue(":rg", $cliente->getNrRg(), PDO::PARAM_STR);
             $stmt->bindValue(":telefone", $cliente->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
             $stmt->bindValue(":nascimento", $cliente->getDtNascimento(), PDO::PARAM_STR);
             $stmt->bindValue(":sexo", $cliente->getTpSexo(), PDO::PARAM_STR);
             $stmt->bindValue(":ec", $cliente->getEstadoCivil()->getCdEstadoCivil(), PDO::PARAM_INT);
             $stmt->bindValue(":cep", $cliente->getEndereco()->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
             $stmt->execute();

             $teste =  true;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }

    public function update (Cliente $cliente){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE `cliente` SET
                     `NM_CLIENTE` = :nome, `NR_CPF` = :cpf, `NR_RG` = :rg,
                     `NR_TELEFONE` = :telefone, `DS_EMAIL` = :email,
                     `DT_NASCIMENTO` = :nascimento, `TP_SEXO` = :sexo,
                     `CD_ESTADO_CIVIL` = :ec, `NR_CEP` = :cep,
                     `DS_SENHA` = :senha 
                     WHERE `CD_CLIENTE` = :codigo";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":nome", $cliente->getNmCliente(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $cliente->getNrCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":rg", $cliente->getNrRg(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $cliente->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":nascimento", $cliente->getDtNascimento(), PDO::PARAM_STR);
            $stmt->bindValue(":sexo", $cliente->getTpSexo(), PDO::PARAM_STR);
            $stmt->bindValue(":ec", $cliente->getEstadoCivil()->getCdEstadoCivil(), PDO::PARAM_INT);
            $stmt->bindValue(":cep", $cliente->getEndereco()->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
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
            $query = "DELETE FROM `cliente` WHERE `CD_CLIENTE` = :codigo";
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
        require_once ("../services/ClienteList.class.php");
        require_once ("../beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $clienteList = new ClienteList();

        try {
            if($nome == ""){
                $sql = "SELECT C.*
                              ,EC.DS_ESTADO_CIVIL                              
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN endereco     E  ON E.NR_CEP = C.NR_CEP
                        WHERE NM_CLIENTE LIKE :nome ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmCliente($row['NM_CLIENTE']);
                $cliente->setNrCpf($row['NR_CPF']);
                $cliente->setNrRg($row['NR_RG']);
                $cliente->setNrTelefone($row['NR_TELEFONE']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setDtNascimento($row['DT_NASCIMENTO']);
                $cliente->setTpSexo($row['TP_SEXO']);
                $cliente->setEstadoCivil(new EstadoCivil());
                $cliente->getEstadoCivil()->setEstadoCivil($row['CD_ESTADO_CIVIL']);
                $cliente->getEstadoCivil()->setCdEstadoCivil($row['DS_ESTADO_CIVIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setDsSenha($row['DS_SENHA']);

                $clienteList->addCliente($cliente);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $clienteList;
    }

    public function getCliente($codigo){
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "        SELECT C.*
                              ,EC.DS_ESTADO_CIVIL                              
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN endereco     E  ON E.NR_CEP = C.NR_CEP
                        WHERE C.CD_CLIENTE = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmCliente($row['NM_CLIENTE']);
                $cliente->setNrCpf($row['NR_CPF']);
                $cliente->setNrRg($row['NR_RG']);
                $cliente->setNrTelefone($row['NR_TELEFONE']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setDtNascimento($row['DT_NASCIMENTO']);
                $cliente->setTpSexo($row['TP_SEXO']);
                $cliente->setEstadoCivil(new EstadoCivil());
                $cliente->getEstadoCivil()->setEstadoCivil($row['CD_ESTADO_CIVIL']);
                $cliente->getEstadoCivil()->setCdEstadoCivil($row['DS_ESTADO_CIVIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setDsSenha($row['DS_SENHA']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }
}