<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ContratoMensalController
{
    public function insert (ContratoMensal $contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->insert($contratoMensal);
        return $retorno;
    }

    public function update (ContratoMensal $contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->update($contratoMensal);
        return $retorno;
    }

    public function delete ($contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->delete($contratoMensal);
        return $retorno;
    }

    public function getList($id){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getList($id);
        return $retorno;
    }

    public function getLista($id){
        require_once ("model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getLista($id);
        return $retorno;
    }



    public function getContratoMensal($contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getContratoMensal($contratoMensal);
        return $retorno;
    }

    public function efetua_pagamento (ContratoMensal $contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->efetua_pagamento($contratoMensal);
        return $retorno;
    }

    public function getListaMensalAtrasada($contrato){
        require_once ("model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getListaMensalAtrasada($contrato);
        return $retorno;
    }
    public function getMensalidadePaga($contrato, $parcela){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getMensalidadePaga($contrato, $parcela);
        return $retorno;
    }

    public function delete_nao_pago ($contrato){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->delete_nao_pago($contrato);
        return $retorno;
    }

}