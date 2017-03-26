<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ContaController
{
    public function insert (Conta $conta){
        require_once("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->insert($conta);
        return $retorno;
    }

    public function update (Conta $conta){
        require_once("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->update($conta);
        return $retorno;
    }

    public function delete ($conta){
        require_once("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->delete($conta);
        return $retorno;
    }

    public function getList($conta){
        require_once ("model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getListConta($conta);
        return $retorno;
    }
    public function getLista($conta){
        require_once("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getListaConta($conta);
        return $retorno;
    }



    public function getConta($conta){
        require_once ("model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getConta($conta);
        return $retorno;
    }

    public function mudar_atual ($codigo, $atual){
        require_once ("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->mudar_atual($codigo, $atual);
        return $retorno;
    }

    public function getContaTotal(){
        require_once ("model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getContaTotal();
        return $retorno;
    }

    public function getContaAtual(){
        require_once ("model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getContaAtual();
        return $retorno;
    }

    public function obterContaAtual(){
        require_once ("../model/ContaDAO.class.php");
        $contaDao = new ContaDAO();
        $retorno = $contaDao->getContaAtual();
        return $retorno;
    }

}