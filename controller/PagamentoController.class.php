<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class PagamentoController
{
    public function insert (Pagamento $pagamento){
        require_once ("../model/PagamentoDAO.class.php");
        $pagamentoDao = new PagamentoDAO();
        $retorno = $pagamentoDao->insert($pagamento);
        return $retorno;
    }

    public function update (Pagamento $pagamento){
        require_once ("../model/PagamentoDAO.class.php");
        $pagamentoDao = new PagamentoDAO();
        $retorno = $pagamentoDao->update($pagamento);
        return $retorno;
    }

    public function delete ($pagamento){
        require_once ("../model/PagamentoDAO.class.php");
        $pagamentoDao = new PagamentoDAO();
        $retorno = $pagamentoDao->delete($pagamento);
        return $retorno;
    }

    public function getList($pagamento){
        require_once ("../model/PagamentoDAO.class.php");
        $pagamentoDao = new PagamentoDAO();
        $retorno = $pagamentoDao->getList($pagamento);
        return $retorno;
    }



    public function getPagamento($pagamento){
        require_once ("../model/PagamentoDAO.class.php");
        $pagamentoDao = new PagamentoDAO();
        $retorno = $pagamentoDao->getPagamento($pagamento);
        return $retorno;
    }

}