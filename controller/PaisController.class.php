<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class PaisController
{
    public function insert (Pais $pais){
        require_once ("model/PaisDAO.class.php");
        $paisDao = new PaisDAO();
        $retorno = $paisDao->insert($pais);
        return $retorno;
    }

    public function update (Pais $pais){
        require_once ("model/PaisDAO.class.php");
        $paisDao = new PaisDAO();
        $retorno = $paisDao->update($pais);
        return $retorno;
    }

    public function delete ($pais){
        require_once ("model/PaisDAO.class.php");
        $paisDao = new PaisDAO();
        $retorno = $paisDao->delete($pais);
        return $retorno;
    }

    public function getList($pais){
        require_once ("model/PaisDAO.class.php");
        $paisDao = new PaisDAO();
        $retorno = $paisDao->getList($pais);
        return $retorno;
    }



    public function getPais($pais){
        require_once ("model/PaisDAO.class.php");
        $paisDao = new PaisDAO();
        $retorno = $paisDao->getPais($pais);
        return $retorno;
    }

}