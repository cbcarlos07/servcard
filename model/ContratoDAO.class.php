<?php


/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:34
 */
include_once ("ConnectionFactory.class.php");

class ContratoDAO
{
     private $connection = null;

     public function insert (Contrato $contrato){
         $this->connection =  null;
         $teste = 0;
         $this->connection = new ConnectionFactory();
         try{
             $query = "INSERT INTO contrato 
                       (CD_CONTRATO, DH_CONTRATO, SN_QUITE, NR_VALOR,
                        NR_PARCELA, CD_CLIENTE, CD_USUARIO, CD_PLANO
                        ,NR_JUROS, TP_STATUS, DIAS_VENCIMENTO) 
                        VALUES 
                        (NULL, CURDATE(), :QUITE, :VALOR, 
                        :PARCELA, :CLIENTE, :USUARIO, :PLANO,
                        :JUROS, 'A', :DIAS)";

             $stmt = $this->connection->prepare($query);
             $stmt->bindValue(":QUITE",   $contrato->getSnQuite(), PDO::PARAM_STR);
             $stmt->bindValue(":VALOR",   $contrato->getNrValor(), PDO::PARAM_STR);
             $stmt->bindValue(":PARCELA", $contrato->getNrParcela(), PDO::PARAM_INT);
             $stmt->bindValue(":CLIENTE", $contrato->getCliente()->getCdCliente(), PDO::PARAM_INT);
             $stmt->bindValue(":USUARIO", $contrato->getUsuario()->getCdUsuario(), PDO::PARAM_INT);
             $stmt->bindValue(":PLANO",   $contrato->getPlano()->getCdPlano(), PDO::PARAM_INT);
             $stmt->bindValue(":JUROS",   $contrato->getNrJuros(), PDO::PARAM_INT);
             $stmt->bindValue(":DIAS",    $contrato->getDiasVencimento(), PDO::PARAM_INT);
             $stmt->execute();
             $lastId = $this->connection->lastInsertId();
             $teste =  $lastId; //pega o ultimom codigo inserido;

             $this->connection =  null;
         }catch(PDOException $exception){
             echo "Erro: ".$exception->getMessage();
         }
         return $teste;
     }




    public function update (Contrato $contrato){
        $this->delete_contrato($contrato->getCdContrato());
        $this->connection =  null;
        $teste = false;
        $this->connection = new ConnectionFactory();
        try{
            $query = "UPDATE contrato SET 
                       SN_QUITE = :QUITE, NR_VALOR = :VALOR, 
                       NR_PARCELA = :PARCELA, CD_CLIENTE =  :CLIENTE, CD_USUARIO = :USUARIO
                      ,CD_PLANO = :PLANO
                      ,NR_JUROS = :JUROS
                      ,DIAS_VENCIMENTO = :DIAS
                      WHERE 
                       CD_CONTRATO = :CODIGO";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(":QUITE", $contrato->getSnQuite(), PDO::PARAM_STR);
            $stmt->bindValue(":VALOR", $contrato->getNrValor(), PDO::PARAM_STR);
            $stmt->bindValue(":PARCELA", $contrato->getNrParcela(), PDO::PARAM_INT);
            $stmt->bindValue(":CLIENTE", $contrato->getCliente()->getCdCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":USUARIO", $contrato->getUsuario()->getCdUsuario(), PDO::PARAM_INT);
            $stmt->bindValue(":PLANO", $contrato->getPlano()->getCdPlano(), PDO::PARAM_INT);
            $stmt->bindValue(":CODIGO", $contrato->getCdContrato(), PDO::PARAM_INT);
            $stmt->bindValue(":JUROS", $contrato->getNrJuros(), PDO::PARAM_INT);
            $stmt->bindValue(":DIAS", $contrato->getDiasVencimento(), PDO::PARAM_INT);
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
            $query = "DELETE FROM contrato WHERE CD_CONTRATO = :codigo";
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

    public function delete_contrato ($codigo){
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

    public function getList($cliente){
        require_once ("services/ContratoList.class.php");
        require_once ("beans/Contrato.class.php");
        require_once ("beans/Cliente.class.php");
        require_once ("beans/Usuario.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contratoList = new ContratoList();

        try {

                $sql = "SELECT C.*, U.NM_USUARIO, P.DS_PLANO, P.NR_VALOR FROM
                         contrato C
                         INNER JOIN usuario U ON C.CD_USUARIO = U.CD_USUARIO
                         INNER JOIN plano   P ON C.CD_PLANO = P.CD_PLANO
                         WHERE C.CD_CLIENTE = :cliente
                         ORDER BY 1 DESC";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(":cliente",$cliente, PDO::PARAM_INT);


                $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contrato = new Contrato();
                $contrato->setCdContrato($row['CD_CONTRATO']);
                $contrato->setDhContrato($row['DH_CONTRATO']);
                $contrato->setSnQuite($row['SN_QUITE']);
                $contrato->setNrValor($row['NR_VALOR']);
                $contrato->setNrParcela($row['NR_PARCELA']);
                $contrato->setCliente(new Cliente());
                $contrato->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setCdUsuario($row['CD_USUARIO']);
                $contrato->getUsuario()->setNmUsuario($row['NM_USUARIO']);
                $contrato->setTpStatus($row['TP_STATUS']);
                $contratoList->addContrato($contrato);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoList;
    }

    public function cancelarContrato(Contrato $contrato){
        require_once ("beans/Contrato.class.php");
        require_once ("beans/Usuario.class.php");
        $teste = false;
        $this->connection = null;

        $this->connection =  new ConnectionFactory();

        try{
            $sql = "UPDATE contrato SET
                    TP_STATUS = 'C', CD_USUARIO_CANCELOU = :usuario,
                    DT_CANCELAMENTO = :dt_cancel, 
                    DS_OBSERVACAO_CANCELAMENTO = :obs_cancel
                    WHERE CD_CONTRATO = :contrato";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":usuario", $contrato->getCdContrato(), PDO::PARAM_INT);
            $dataArray = explode('/',$contrato->getDtCancelamento());
            $dia = $dataArray[0];
            $mes = $dataArray[1];
            $ano = $dataArray[2];
            $stmt->bindValue(":dt_cancel", "$ano-$mes-$dia", PDO::PARAM_STR);
            $stmt->bindValue(":obs_cancel", $contrato->getDsObervacao(), PDO::PARAM_STR);
            $stmt->bindValue(":contrato", $contrato->getCdContrato(), PDO::PARAM_INT);

            $stmt->execute();
            $teste = true;

        }catch (PDOException $ex){
            echo "Erro: ".$ex->getMessage();
        }
        return $teste;

    }

    public function getLista($cliente){
        require_once ("../services/ContratoList.class.php");
        require_once ("../beans/Contrato.class.php");
        require_once ("../beans/Cliente.class.php");

        $this->connection = null;

        $this->connection = new ConnectionFactory();

        $contratoList = new ContratoList();

        try {

            $sql = "SELECT C.*, U.NM_USUARIO, P.DS_PLANO FROM 
                        contrato C
                        INNER JOIN cliente T ON C.CD_CLIENTE = T.CD_CLIENTE
                        INNER JOIN usuario U ON C.CD_USUARIO = U.CD_USUARIO
                        INNER JOIN plano   P ON C.CD_PLANO = P.CD_PLANO
                        WHERE C.CD_CLIENTE = :cliente
                        ORDER BY 1 DESC";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":cliente", $cliente, PDO::PARAM_INT);


            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $contrato = new Contrato();
                $contrato->setCdContrato($row['CD_CONTRATO']);
                $contrato->setDhContrato($row['DH_CONTRATO']);
                $contrato->setSnQuite($row['SN_QUITE']);
                $contrato->setNrValor($row['NR_VALOR']);
                $contrato->setNrParcela($row['NR_PARCELA']);
                $contrato->setCliente(new Cliente());
                $contrato->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setCdUsuario($row['CD_USUARIO']);
                $contrato->getUsuario()->setNmUsuario($row['NM_USUARIO']);
                $contrato->setTpStatus($row['TP_STATUS']);
                $contratoList->addContrato($contrato);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contratoList;
    }


    public function getContrato($codigo){
        require_once "beans/Cliente.class.php";
        require_once "beans/Usuario.class.php";
        require_once "beans/Plano.class.php";
        $contrato = null;
        $connection = null;
        $this->connection =  new ConnectionFactory();
        $sql = "SELECT * FROM contrato WHERE CD_CONTRATO = :codigo";

        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":codigo", $codigo, PDO::PARAM_INT);
            $stmt->execute();
            if($row =  $stmt->fetch(PDO::FETCH_ASSOC)){
                $contrato = new Contrato();
                $contrato->setCdContrato($row['CD_CONTRATO']);
                $contrato->setDhContrato($row['DH_CONTRATO']);
                $contrato->setSnQuite($row['SN_QUITE']);
                $contrato->setNrValor($row['NR_VALOR']);
                $contrato->setNrParcela($row['NR_PARCELA']);
                $contrato->setNrJuros($row['NR_JUROS']);
                $contrato->setCliente(new Cliente());
                $contrato->getCliente()->setCdCliente($row['CD_CLIENTE']);
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setCdUsuario($row['CD_USUARIO']);
                $contrato->setPlano(new Plano());
                $contrato->getPlano()->setCdPlano($row['CD_PLANO']);
                $contrato->setDiasVencimento($row['DIAS_VENCIMENTO']);
            }
            $this->connection = null;
        } catch (PDOException $ex) {
            echo "Erro: ".$ex->getMessage();
        }
        return $contrato;
    }
}