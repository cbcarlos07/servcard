<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 20/02/17
 * Time: 19:04
 */
class ClienteController
{
    public function insert (Cliente $cliente){
        require_once ("../model/ClienteDAO.class.php");
        $clienteDao = new ClienteDAO();
        $retorno = $clienteDao->insert($cliente);
        return $retorno;
    }

    public function update (Cliente $cliente){
        require_once ("../model/ClienteDAO.class.php");
        $clienteDao = new ClienteDAO();
        $retorno = $clienteDao->update($cliente);
        return $retorno;
    }

    public function delete ($cliente){
        require_once ("../model/ClienteDAO.class.php");
        $clienteDao = new ClienteDAO();
        $retorno = $clienteDao->delete($cliente);
        return $retorno;
    }

    public function getList($cliente){
        require_once ("../model/ClienteDAO.class.php");
        $clienteDao = new ClienteDAO();
        $retorno = $clienteDao->getList($cliente);
        return $retorno;
    }



    public function getCliente($cliente){
        require_once ("../model/ClienteDAO.class.php");
        $clienteDao = new ClienteDAO();
        $retorno = $clienteDao->getCliente($cliente);
        return $retorno;
    }

}