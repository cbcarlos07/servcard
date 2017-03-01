<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class EstadoCivilController
{
    public function insert (EstadoCivil $estadoCivil){
        require_once ("../model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->insert($estadoCivil);
        return $retorno;
    }

    public function update (EstadoCivil $estadoCivil){
        require_once ("../model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->update($estadoCivil);
        return $retorno;
    }

    public function delete ($estadoCivil){
        require_once ("../model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->delete($estadoCivil);
        return $retorno;
    }

    public function getList($estadoCivil){
        require_once ("model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->getList($estadoCivil);
        return $retorno;
    }

    public function getLista($estadoCivil){
        require_once ("../model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->getLista($estadoCivil);
        return $retorno;
    }



    public function getEstadoCivil($estadoCivil){
        require_once ("model/EstadoCivilDAO.class.php");
        $estadoCivilDao = new EstadoCivilDAO();
        $retorno = $estadoCivilDao->getEstadoCivil($estadoCivil);
        return $retorno;
    }

}