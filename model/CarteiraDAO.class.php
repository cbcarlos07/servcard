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
                           SN_TITULAR, CD_CLIENTE, CD_CONTRATO, DT_CADASTRO) 
                           VALUES (
                           NULL, :validade, :ativo, :titular,
                            :cliente,  :contrato, curdate()
                           )";


             $stmt = $this->connection->prepare($query);
             $dataApp = explode('/',$carteira->getDtValidade());
          //   echo "Data validade: $dataApp[2]-$dataApp[1]-$dataApp[0] \n";
           //  echo "Cliente: ".$carteira->getCliente()->getCdCliente()." \n";
             $stmt->bindValue(":cliente", $carteira->getCliente()->getCdCliente(), PDO::PARAM_INT);

             $stmt->bindValue(":validade","$dataApp[2]-$dataApp[1]-$dataApp[0]", PDO::PARAM_STR);
             $stmt->bindValue(":ativo", $carteira->getSnAtivo(), PDO::PARAM_STR);
             $stmt->bindValue(":titular", $carteira->getSnTitular(), PDO::PARAM_STR);
             $stmt->bindValue(":contrato", $carteira->getContrato()->getCdContrato(), PDO::PARAM_INT);

             $stmt->execute();
             //$lastId = $this->connection->lastInsertId();
             $teste = true;

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
            $query = "UPDATE carteira SET 
                      DT_VALIDADE = :validade, SN_ATIVO = :ativo,
                      SN_TITULAR = :tptitular, CD_CLIENTE = :cliente,
                      CD_CONTRATO = :contrato
                      WHERE CD_CARTEIRA = :codigo";
            $stmt = $this->connection->prepare($query);
            $dataApp = explode('/', $carteira->getDtValidade());
            $stmt->bindValue(":codigo", $carteira->getCdCarteira(), PDO::PARAM_INT);
            $stmt->bindValue(":cliente", $carteira->getCliente()->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":contrato", $carteira->getContrato()->getCdContrato(), PDO::PARAM_INT);
            $stmt->bindValue(":validade","$dataApp[2]-$dataApp[1]-$dataApp[0]", PDO::PARAM_STR);
            $stmt->bindValue(":ativo", $carteira->getSnAtivo(), PDO::PARAM_STR);
            $stmt->bindValue(":tptitular", $carteira->getSnTitular(), PDO::PARAM_STR);

            $stmt->execute();

            $teste =  true;

            $this->connection =  null;
        }catch(PDOException $exception){
            echo "Erro: ".$exception->getMessage();
        }
        return $teste;
    }

    public function inativar_carteira(Carteira $carteira){
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE carteira SET 
                        SN_ATIVO = 'N'
                        ,DT_INATIVACAO             = curdate()
                        ,CD_USUARIO_DESATIVOU      = :usuario
                        ,DS_OBSERVACAO_INATIVACAO  = :observacao
                      WHERE CD_CARTEIRA = :codigo";
            $stmt = $this->connection->prepare($query);

            $stmt->bindValue(":codigo", $carteira->getCdCarteira(), PDO::PARAM_INT);
            $stmt->bindValue(":usuario", $carteira->getUsuario()->getCdUsuario(), PDO::PARAM_INT);
            $stmt->bindValue(":observacao", $carteira->getObsInativacao(), PDO::PARAM_STR);

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
            $query = "DELETE FROM carteira WHERE CD_CARTEIRA = :codigo";
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

                $sql = "SELECT C.*
                               ,CLI.*
                               ,CO.CD_CONTRATO  CONTRATO
                               ,CO.CD_CLIENTE   COD_CLIENTE
                               ,CO.SN_ATIVO     ATIVO
                               ,CLIE.NM_CLIENTE CLIENTE
                               ,P.*
                          FROM carteira C
                        INNER JOIN cliente  CLI  ON C.CD_CLIENTE = CLI.CD_CLIENTE
                        INNER JOIN contrato CO   ON C.CD_CONTRATO = CO.CD_CONTRATO
                        INNER JOIN cliente  CLIE ON CLIE.CD_CLIENTE = CO.CD_CLIENTE
                        INNER JOIN plano   P    ON CO.CD_PLANO = P.CD_PLANO
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
                $carteira->getCliente()->setNmSobrenome($row['NM_SOBRENOME']);
                $carteira->setSnAtivo($row['SN_ATIVO']);
                $carteira->setSnTitular($row['SN_TITULAR']);
                $carteira->setDtValidade($row['DT_VALIDADE']);
                $carteira->setContrato(new Contrato());
                $carteira->getContrato()->setCdContrato($row['CD_CONTRATO']);
                $carteira->getContrato()->setSnAtivo($row['ATIVO']);
                $carteira->getContrato()->setPlano(new Plano());
                $carteira->getContrato()->getPlano()->setCdPlano($row['CD_PLANO']);
                $carteira->getContrato()->getPlano()->setDsPlano($row['DS_PLANO']);
                $carteira->getContrato()->setCliente(new Cliente());
                $carteira->getContrato()->getCliente()->setCdCliente($row['COD_CLIENTE']);
                $carteira->getContrato()->getCliente()->setNmCliente($row['CLIENTE']);


                $carteiraList->addCarteira($carteira);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteiraList;
    }


    public function getCarteira($codigo){
        require_once "beans/Cliente.class.php";
        require_once "beans/Plano.class.php";
        require_once "beans/Contrato.class.php";
        require_once "beans/Carteira.class.php";
        $carteira = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT C.CD_CARTEIRA
                  ,C.SN_ATIVO
                  ,C.CD_CLIENTE
                  ,C.SN_TITULAR
                  ,CO.CD_CONTRATO
                  ,CONCAT(CLI.NM_CLIENTE, ' ',CLI.NM_SOBRENOME)  NOME 
                  ,CM.VENCIMENTO
                              FROM carteira C
                INNER JOIN contrato  CO  ON C.CD_CONTRATO = CO.CD_CONTRATO
                INNER JOIN cliente   CLI ON CLI.CD_CLIENTE =  CO.CD_CLIENTE
                INNER JOIN (SELECT CM.CD_CONTRATO CONTRATO,  MAX(DT_VENCIMENTO) VENCIMENTO FROM contrato_mensal CM GROUP BY 1)  CM ON CM.CONTRATO = CO.CD_CONTRATO
                WHERE C.CD_CARTEIRA = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = new Carteira();
                $carteira->setCdCarteira($row['CD_CARTEIRA']);
                $carteira->setSnAtivo($row['SN_ATIVO']);
                $carteira->setSnTitular($row['SN_TITULAR']);
                $carteira->setDtValidade($row['VENCIMENTO']);
                $carteira->setCliente(new Cliente());
                $carteira->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $carteira->setContrato(new Contrato());
                $carteira->getContrato()->setCdContrato($row['CD_CONTRATO']);
                $carteira->getContrato()->setCliente(new Cliente());
                $carteira->getContrato()->getCliente()->setNmCliente($row['NOME']);


            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteira;
    }

    public function getCarteiraCancelada($codigo){
        require_once "beans/Cliente.class.php";
        require_once "beans/Usuario.class.php";
        require_once "beans/Contrato.class.php";
        require_once "beans/Carteira.class.php";
        $carteira = null;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT C.CD_CLIENTE
                      ,C.CD_USUARIO_DESATIVOU
                      ,C.DT_INATIVACAO
                      ,C.DS_OBSERVACAO_INATIVACAO
                      ,U.DS_LOGIN
                FROM 
                carteira C
                LEFT JOIN usuario U ON U.CD_USUARIO = C.CD_USUARIO_DESATIVOU
                WHERE C.CD_CARTEIRA = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = new Carteira();
                $carteira->setCliente(new Cliente());
                $carteira->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $carteira->setUsuario(new Usuario());
                $carteira->getUsuario()->setDsLogin($row['DS_LOGIN']);
                $carteira->setDtInativacao($row['DT_INATIVACAO']);
                $carteira->setObsInativacao($row['DS_OBSERVACAO_INATIVACAO']);


            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteira;
    }

    public function getDependente($contrato){
        $carteira = 0;
        $this->connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT COUNT(*) TOTAL
                  FROM carteira C 
                  WHERE C.SN_ATIVO = 'S' 
                  AND C.SN_TITULAR = 'N' 
                  AND C.CD_CONTRATO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $contrato, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = $row['TOTAL'];


            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteira;
    }

    public function getListaDependente($codigo){
        require_once ("services/CarteiraList.class.php");
        require_once "beans/Cliente.class.php";
        require_once "beans/Usuario.class.php";
        require_once "beans/Plano.class.php";
        $carteira = null;
        $carteiraList = new CarteiraList();
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT C.CD_CARTEIRA
                      ,CONCAT(CL.NM_CLIENTE,' ',CL.NM_SOBRENOME) CLIENTE
                      ,C.CD_CLIENTE
                      ,C.DT_VALIDADE
                  FROM carteira C 
                  INNER JOIN cliente CL  ON C.CD_CLIENTE = CL.CD_CLIENTE
                  INNER JOIN contrato CO ON CO.CD_CONTRATO = C.CD_CONTRATO
                  WHERE C.SN_ATIVO = 'S'
                  AND   C.SN_TITULAR = 'N'
                  AND   C.CD_CONTRATO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            while($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $carteira = new Carteira();
                $carteira->setCdCarteira($row['CD_CARTEIRA']);
                $carteira->setCliente(new Cliente());
                $carteira->getCliente()->setNmCliente($row['CLIENTE']);
                $carteira->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $carteira->setDtValidade($row['DT_VALIDADE']);
                $carteiraList->addCarteira($carteira);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $carteiraList;
    }
}