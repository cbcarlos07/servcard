<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ContratoController
{
    public function insert (Contrato $contrato){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->insert($contrato);
        return $retorno;
    }

    public function update (Contrato $contrato){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->update($contrato);
        return $retorno;
    }

    public function delete ($contrato){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->delete($contrato);
        return $retorno;
    }

    public function cancelar_contrato (Contrato $contrato){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->cancelar_contrato($contrato);
        return $retorno;
    }

    public function getList($contrato){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getList($contrato);
        return $retorno;
    }
    public function getLista($nome){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getLista($nome);
        return $retorno;
    }


    public function getContrato($contrato){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getContrato($contrato);
        return $retorno;
    }

    public function obterContrato($contrato){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->obterContrato($contrato);
        return $retorno;
    }

    public function getContratoCancelado($codigo){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getContratoCancelado($codigo);
        return $retorno;
    }

    public function getListaByCPF($cpf){
        require_once ("../model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getListaByCPF($cpf);
        return $retorno;
    }

    public function getClienteDivida($nome,$inicio, $limite){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getClienteDivida($nome,$inicio, $limite);
        return $retorno;
    }

    public function getClienteDividaPrint(){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getClienteDividaPrint();
        return $retorno;
    }
    public function getTotalAtraso($cdcontrato){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getTotalAtraso($cdcontrato);
        return $retorno;
    }

    public function getTotalClienteDivida(){
        require_once ("model/ContratoDAO.class.php");
        $contratoDao = new ContratoDAO();
        $retorno = $contratoDao->getTotalClienteDivida();
        return $retorno;
    }

}