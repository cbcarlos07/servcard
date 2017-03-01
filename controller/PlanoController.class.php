<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class PlanoController
{
    public function insert (Plano $plano){
        require_once ("../model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->insert($plano);
        return $retorno;
    }

    public function update (Plano $plano){
        require_once ("../model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->update($plano);
        return $retorno;
    }

    public function delete ($plano){
        require_once ("../model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->delete($plano);
        return $retorno;
    }

    public function getList($plano){
        require_once ("model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->getList($plano);
        return $retorno;
    }

    public function getLista($plano){
        require_once ("../model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->getLista($plano);
        return $retorno;
    }



    public function getPlano($plano){
        require_once ("model/PlanoDAO.class.php");
        $planoDao = new PlanoDAO();
        $retorno = $planoDao->getPlano($plano);
        return $retorno;
    }

}