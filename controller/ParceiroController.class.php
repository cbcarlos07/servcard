<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ParceiroController
{
    public function insert (Parceiro $parceiro){
        require_once ("../model/ParceiroDAO.class.php");
        $parceiroDao = new ParceiroDAO();
        $retorno = $parceiroDao->insert($parceiro);
        return $retorno;
    }

    public function update (Parceiro $parceiro){
        require_once ("../model/ParceiroDAO.class.php");
        $parceiroDao = new ParceiroDAO();
        $retorno = $parceiroDao->update($parceiro);
        return $retorno;
    }

    public function delete ($parceiro){
        require_once ("../model/ParceiroDAO.class.php");
        $parceiroDao = new ParceiroDAO();
        $retorno = $parceiroDao->delete($parceiro);
        return $retorno;
    }

    public function getList($parceiro){
        require_once ("../model/ParceiroDAO.class.php");
        $parceiroDao = new ParceiroDAO();
        $retorno = $parceiroDao->getList($parceiro);
        return $retorno;
    }



    public function getParceiro($parceiro){
        require_once ("../model/ParceiroDAO.class.php");
        $parceiroDao = new ParceiroDAO();
        $retorno = $parceiroDao->getParceiro($parceiro);
        return $retorno;
    }

}