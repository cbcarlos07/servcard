<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:16
 */
class Contrato
{
private $cdContrato;
private $dhContrato;
private $snQuite;
private $nrValor;
private $nrParcela;
private $cliente;
private $usuario;

    /**
     * @return mixed
     */
    public function getCdContrato()
    {
        return $this->cdContrato;
    }

    /**
     * @param mixed $cdContrato
     * @return Contrato
     */
    public function setCdContrato($cdContrato)
    {
        $this->cdContrato = $cdContrato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDhContrato()
    {
        return $this->dhContrato;
    }

    /**
     * @param mixed $dhContrato
     * @return Contrato
     */
    public function setDhContrato($dhContrato)
    {
        $this->dhContrato = $dhContrato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnQuite()
    {
        return $this->snQuite;
    }

    /**
     * @param mixed $snQuite
     * @return Contrato
     */
    public function setSnQuite($snQuite)
    {
        $this->snQuite = $snQuite;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrValor()
    {
        return $this->nrValor;
    }

    /**
     * @param mixed $nrValor
     * @return Contrato
     */
    public function setNrValor($nrValor)
    {
        $this->nrValor = $nrValor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrParcela()
    {
        return $this->nrParcela;
    }

    /**
     * @param mixed $nrParcela
     * @return Contrato
     */
    public function setNrParcela($nrParcela)
    {
        $this->nrParcela = $nrParcela;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     * @return Contrato
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     * @return Contrato
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }



}