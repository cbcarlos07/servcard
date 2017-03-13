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
                       (`NM_CLIENTE`, `NM_SOBRENOME`,`NR_CPF`, `NR_RG`, `NR_TELEFONE`, 
                       `DS_EMAIL`, `DT_NASCIMENTO`, `TP_SEXO`, `CD_ESTADO_CIVIL`, 
                       `CD_ENDERECO`, `NR_CASA`, `DS_COMPLEMENTO`,`DS_SENHA`,`SN_SENHA_ATUAL`, 
                       `DT_CADASTRO`) 
                       VALUES 
                       (:nome, :sobrenome, :cpf, :rg, :telefone, 
                       :email, :nascimento, :sexo, :ec, 
                       :endereco, :numero, :complemento, MD5(:senha), :atual, curdate())";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":nome", $cliente->getNmCliente(), PDO::PARAM_STR);
             $stmt->bindValue(":sobrenome", $cliente->getNmSobrenome(), PDO::PARAM_STR);
             $stmt->bindValue(":cpf", $cliente->getNrCpf(), PDO::PARAM_STR);
             $stmt->bindValue(":rg", $cliente->getNrRg(), PDO::PARAM_STR);
             $stmt->bindValue(":telefone", $cliente->getNrTelefone(), PDO::PARAM_STR);
             $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
             $stmt->bindValue(":nascimento", $cliente->getDtNascimento(), PDO::PARAM_STR);
             $stmt->bindValue(":sexo", $cliente->getTpSexo(), PDO::PARAM_STR);
             $stmt->bindValue(":ec", $cliente->getEstadoCivil()->getCdEstadoCivil(), PDO::PARAM_INT);
             $stmt->bindValue(":endereco", $cliente->getEndereco()->getCdEndereco(), PDO::PARAM_INT);
             $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
             $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
             $stmt->bindValue(":atual", $cliente->getSnSenhaAtual(), PDO::PARAM_STR);
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
                       `NM_CLIENTE` = :nome, `NM_SOBRENOME` = :sobrenome, `NR_CPF` = :cpf, `NR_RG` = :rg, `NR_TELEFONE` = :telefone, 
                       `DS_EMAIL` = :email, `DT_NASCIMENTO` = :nascimento, `TP_SEXO` = :sexo, `CD_ESTADO_CIVIL` = :ec, 
                       `CD_ENDERECO` = :endereco, `NR_CASA` =  :numero, `DS_COMPLEMENTO` = :complemento, 
                       `DS_SENHA` = MD5(:senha),`SN_SENHA_ATUAL` = :atual, `DT_ATUALIZACAO` = curdate() 
                       WHERE
                        `CD_CLIENTE` = :codigo";

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":codigo", $cliente->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":nome", $cliente->getNmCliente(), PDO::PARAM_STR);
            $stmt->bindValue(":sobrenome", $cliente->getNmSobrenome(), PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $cliente->getNrCpf(), PDO::PARAM_STR);
            $stmt->bindValue(":rg", $cliente->getNrRg(), PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $cliente->getNrTelefone(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $cliente->getDsEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":nascimento", $cliente->getDtNascimento(), PDO::PARAM_STR);
            $stmt->bindValue(":sexo", $cliente->getTpSexo(), PDO::PARAM_STR);
            $stmt->bindValue(":ec", $cliente->getEstadoCivil()->getCdEstadoCivil(), PDO::PARAM_INT);
            $stmt->bindValue(":endereco", $cliente->getEndereco()->getCdEndereco(), PDO::PARAM_INT);
            $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":atual", $cliente->getSnSenhaAtual(), PDO::PARAM_STR);
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

    /**
     * @param $nome
     * @return ClienteList
     */
    public function getList($nome){
        require_once ("services/ClienteList.class.php");
        require_once ("beans/Cliente.class.php");
        require_once ("beans/EstadoCivil.class.php");
        require_once ("beans/Endereco.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $clienteList = new ClienteList();
        $stmt = null;
        try {
            if($nome == ""){
                $sql = "SELECT C.*
                              ,EC.DS_ESTADO_CIVIL
                              ,E.CD_ENDERECO
                              ,E.NR_CEP                              
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN endereco     E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        WHERE NM_CLIENTE LIKE :nome ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmCliente($row['NM_CLIENTE']);
                $cliente->setNmSobrenome($row['NM_SOBRENOME']);
                $cliente->setNrCpf($row['NR_CPF']);
                $cliente->setNrRg($row['NR_RG']);
                $cliente->setNrTelefone($row['NR_TELEFONE']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setDtNascimento($row['DT_NASCIMENTO']);
                $cliente->setTpSexo($row['TP_SEXO']);
                $cliente->setEstadoCivil(new EstadoCivil());
                $cliente->getEstadoCivil()->setCdEstadoCivil($row['CD_ESTADO_CIVIL']);
                $cliente->getEstadoCivil()->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setDsSenha($row['DS_SENHA']);
                $cliente->setSnSenhaAtual($row['SN_SENHA_ATUAL']);

                $clienteList->addCliente($cliente);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $clienteList;
    }

    public function getLista($nome){
        require_once ("../services/ClienteList.class.php");
        require_once ("../beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $clienteList = new ClienteList();
        $stmt = null;
        try {
            if($nome == ""){
                $sql = "SELECT C.*
                              ,EC.DS_ESTADO_CIVIL
                              ,E.CD_ENDERECO
                              ,E.NR_CEP                              
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN endereco     E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        WHERE NM_CLIENTE LIKE :nome ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
            }
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmCliente($row['NM_CLIENTE']);
                $cliente->setNmSobrenome($row['NM_SOBRENOME']);
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
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->setDsSenha($row['DS_SENHA']);
                $cliente->setSnSenhaAtual($row['SN_SENHA_ATUAL']);
                $clienteList->addCliente($cliente);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $clienteList;
    }

    public function getCliente($codigo){
        require_once "beans/Cliente.class.php";
        require_once "beans/Endereco.class.php";
        require_once "beans/EstadoCivil.class.php";
        require_once "beans/TpLogradouro.class.php";
        require_once "beans/Bairro.class.php";
        require_once "beans/Cidade.class.php";
        require_once "beans/Estado.class.php";
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM cliente C 
                        INNER JOIN estado_civil  EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN endereco      E  ON E.CD_ENDERECO = C.CD_ENDERECO
                        INNER JOIN tp_logradouro T  ON E.CD_TP_LOGRADOURO = T.CD_TP_LOGRADOURO
                        INNER JOIN bairro        B  ON E.CD_BAIRRO = B.CD_BAIRRO
                        INNER JOIN cidade        CI ON B.CD_CIDADE = CI.CD_CIDADE
                        INNER JOIN estado        ES ON CI.CD_ESTADO = ES.CD_ESTADO
                        WHERE C.CD_CLIENTE = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                $cliente->setCdCliente($row['CD_CLIENTE']);
                $cliente->setNmCliente($row['NM_CLIENTE']);
                $cliente->setNmSobrenome($row['NM_SOBRENOME']);
                $cliente->setNrCpf($row['NR_CPF']);
                $cliente->setNrRg($row['NR_RG']);
                $cliente->setNrTelefone($row['NR_TELEFONE']);
                $cliente->setDsEmail($row['DS_EMAIL']);
                $cliente->setDtNascimento($row['DT_NASCIMENTO']);
                $cliente->setTpSexo($row['TP_SEXO']);
                $cliente->setEstadoCivil(new EstadoCivil());
                $cliente->getEstadoCivil()->setCdEstadoCivil($row['CD_ESTADO_CIVIL']);
                $cliente->getEstadoCivil()->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);
                $cliente->setEndereco(new Endereco());
                $cliente->getEndereco()->setCdEndereco($row['CD_ENDERECO']);
                $cliente->getEndereco()->setNrCep($row['NR_CEP']);
                $cliente->getEndereco()->setDsLogradouro($row['DS_LOGRADOURO']);
                $cliente->setNrCasa($row['NR_CASA']);
                $cliente->setDsComplemento($row['DS_COMPLEMENTO']);
                $cliente->setDsSenha($row['DS_SENHA']);
                $cliente->setSnSenhaAtual($row['SN_SENHA_ATUAL']);
                $cliente->setDtCadastro($row['DT_CADASTRO']);
                $cliente->getEndereco()->setTpLogradouro(new TpLogradouro());
                $cliente->getEndereco()->getTpLogradouro()->setDsTpLogradouro($row['DS_TP_LOGRADOURO']);
                $cliente->getEndereco()->setBairro(new Bairro());
                $cliente->getEndereco()->getBairro()->setNmBairro($row['NM_BAIRRO']);
                $cliente->getEndereco()->getBairro()->setCidade(new Cidade());
                $cliente->getEndereco()->getBairro()->getCidade()->setNmCidade($row['NM_CIDADE']);
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->setEstado(new Estado());
                $cliente->getEndereco()->getBairro()->getCidade()->getEstado()->setNmEstado($row['NM_ESTADO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }
}