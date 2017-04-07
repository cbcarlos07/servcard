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
         $this->connection->beginTransaction();
         try{
             $query = "INSERT INTO cliente 
                       (CD_CLIENTE, NM_CLIENTE, NM_SOBRENOME, NR_CPF, NR_RG, NR_TELEFONE, 
                       DS_EMAIL, DT_NASCIMENTO, TP_SEXO, CD_ESTADO_CIVIL, 
                       DS_SENHA, NR_CEP, CD_BAIRRO,  NR_CASA, DS_COMPLEMENTO, 
                       SN_SENHA_ATUAL, DT_CADASTRO)
                         VALUES (
                         NULL, :nome, :sobrenome, :cpf, :rg, :telefone,
                               :email, :nascimento, :sexo, :ec,
                               MD5(:senha), :endereco, :bairro,  :numero, :complemento,
                               :atual, curdate()
                         )";

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
             $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
             $stmt->bindValue(":endereco", $cliente->getNrCep(), PDO::PARAM_STR);
             $stmt->bindValue(":bairro", $cliente->getBairro()->getCdBairro(), PDO::PARAM_INT);
             $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
             $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
             $stmt->bindValue(":atual", $cliente->getSnSenhaAtual(), PDO::PARAM_STR);
             $stmt->execute();
             $this->connection->commit();

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
        $this->connection->beginTransaction();
        try{
            $query = "UPDATE `cliente` SET
                       `NM_CLIENTE` = :nome, `NM_SOBRENOME` = :sobrenome, `NR_CPF` = :cpf,
                        `NR_RG` = :rg, `NR_TELEFONE` = :telefone, 
                       `DS_EMAIL` = :email, `DT_NASCIMENTO` = :nascimento, `TP_SEXO` = :sexo, `CD_ESTADO_CIVIL` = :ec, 
                       NR_CEP = :cep,`CD_BAIRRO` = :endereco, `NR_CASA` =  :numero, `DS_COMPLEMENTO` = :complemento, 
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
            $stmt->bindValue(":cep", $cliente->getNrCep(), PDO::PARAM_STR);
            $stmt->bindValue(":endereco", $cliente->getBairro()->getCdBairro(), PDO::PARAM_INT);
            $stmt->bindValue(":numero", $cliente->getNrCasa(), PDO::PARAM_STR);
            $stmt->bindValue(":complemento", $cliente->getDsComplemento(), PDO::PARAM_STR);
            $stmt->bindValue(":senha", $cliente->getDsSenha(), PDO::PARAM_STR);
            $stmt->bindValue(":atual", $cliente->getSnSenhaAtual(), PDO::PARAM_STR);
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
            $query = "DELETE FROM `cliente` WHERE `CD_CLIENTE` = :codigo";
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

    /**
     * @param $nome
     * @return ClienteList
     */
    public function getList($nome, $inicio, $limite){
        //include "include/error.php";
        require_once ("services/ClienteList.class.php");
        require_once ("beans/Cliente.class.php");
        require_once ("beans/EstadoCivil.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        //echo "Inicio: ".$inicio."<br>";
        //echo "Fim: ".$limite."<br>";
        //echo "Nome: ".$nome;
        $clienteList = new ClienteList();
        $stmt = null;
        try {

                $sql = "SELECT C.*
                              ,EC.DS_ESTADO_CIVIL                           
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        WHERE NM_CLIENTE LIKE :nome
                        ORDER BY C.NM_CLIENTE ASC
                        LIMIT :inicio, :limite
                        ";

                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":nome", "%$nome%", PDO::PARAM_STR);
                $stmt->bindValue(":inicio", $inicio, PDO::PARAM_INT);
                $stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = new Cliente();
                //echo "Cod Cliente: ".$row['CD_CLIENTE'];
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
                $cliente->setNrCep($row['NR_CEP']);
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
                        FROM cliente C 
                        INNER JOIN estado_civil EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
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
                $cliente->setNrCep($row['NR_CEP']);
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
        require_once "beans/EstadoCivil.class.php";
        require_once "beans/Bairro.class.php";
        require_once "beans/Cidade.class.php";
        require_once "beans/Estado.class.php";
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM cliente C 
                        INNER JOIN estado_civil  EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
                        INNER JOIN bairro        B  ON C.CD_BAIRRO = B.CD_BAIRRO
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
                $cliente->setNrCasa($row['NR_CASA']);
                $cliente->setDsComplemento($row['DS_COMPLEMENTO']);
                $cliente->setDsSenha($row['DS_SENHA']);
                $cliente->setSnSenhaAtual($row['SN_SENHA_ATUAL']);
                $cliente->setDtCadastro($row['DT_CADASTRO']);
                $cliente->setNrCep($row['NR_CEP']);

            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }

    public function obterCliente($codigo){
        require_once "../beans/Cliente.class.php";
        require_once "../beans/Endereco.class.php";
        require_once "../beans/EstadoCivil.class.php";
        require_once "../beans/TpLogradouro.class.php";
        require_once "../beans/Bairro.class.php";
        require_once "../beans/Cidade.class.php";
        require_once "../beans/Estado.class.php";
        $cliente = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT *
                        FROM cliente C 
                        INNER JOIN estado_civil  EC ON EC.CD_ESTADO_CIVIL = C.CD_ESTADO_CIVIL
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
                $cliente->getEstadoCivil()->setDsEstadoCivil($row['DS_ESTADO_CIVIL']);;
                $cliente->setNrCasa($row['NR_CASA']);
                $cliente->setDsComplemento($row['DS_COMPLEMENTO']);
                $cliente->setDsSenha($row['DS_SENHA']);
                $cliente->setSnSenhaAtual($row['SN_SENHA_ATUAL']);
                $cliente->setDtCadastro($row['DT_CADASTRO']);
                $cliente->setNrCep($row['NR_CEP']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }


    public function getTotalCliente(){
        $cliente = 0;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql =          "SELECT COUNT(*) TOTAL
                        FROM cliente C 
                        ";

        try {
            $stmt = $this->connection->prepare($sql);

            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $cliente = $row['TOTAL'];
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $cliente;
    }
}