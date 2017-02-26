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

    public function getList(){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getList();
        return $retorno;
    }



    public function getContratoMensal($contratoMensal){
        require_once ("../model/ContratoMensalDAO.class.php");
        $contratoMensalDao = new ContratoMensalDAO();
        $retorno = $contratoMensalDao->getContratoMensal($contratoMensal);
        return $retorno;
    }

}