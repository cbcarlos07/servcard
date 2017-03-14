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

}