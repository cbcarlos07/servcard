<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class CarteiraController
{
    public function insert (Carteira $carteira){
        require_once ("../model/CarteiraDAO.class.php");
        $carteiraDao = new CarteiraDAO();
        $retorno = $carteiraDao->insert($carteira);
        return $retorno;
    }

    public function update (Carteira $carteira){
        require_once ("../model/CarteiraDAO.class.php");
        $carteiraDao = new CarteiraDAO();
        $retorno = $carteiraDao->update($carteira);
        return $retorno;
    }

    public function delete ($carteira){
        require_once ("../model/CarteiraDAO.class.php");
        $carteiraDao = new CarteiraDAO();
        $retorno = $carteiraDao->delete($carteira);
        return $retorno;
    }

    public function getListByCarteira ($carteira){
        require_once ("model/CarteiraDAO.class.php");
        $carteiraDao = new CarteiraDAO();
        $retorno = $carteiraDao->getListByCarteira($carteira);
        return $retorno;
    }

   

    public function getCarteira($carteira){
        require_once ("../model/CarteiraDAO.class.php");
        $carteiraDao = new CarteiraDAO();
        $retorno = $carteiraDao->getCarteira($carteira);
        return $retorno;
    }

}