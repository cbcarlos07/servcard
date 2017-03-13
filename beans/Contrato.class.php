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
private $plano;
private $nrJuros;
private $tpStatus;
private $usurioCancelou;
private $dtCancelamento;
private $dsObervacao;
private $diasVencimento;
private $tpTitular;

    /**
     * @return mixed
     */
    public function getTpTitular()
    {
        return $this->tpTitular;
    }

    /**
     * @param mixed $tpTitular
     * @return Contrato
     */
    public function setTpTitular($tpTitular)
    {
        $this->tpTitular = $tpTitular;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getDiasVencimento()
    {
        return $this->diasVencimento;
    }

    /**
     * @param mixed $diasVencimento
     * @return Contrato
     */
    public function setDiasVencimento($diasVencimento)
    {
        $this->diasVencimento = $diasVencimento;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getTpStatus()
    {
        return $this->tpStatus;
    }

    /**
     * @param mixed $tpStatus
     * @return Contrato
     */
    public function setTpStatus($tpStatus)
    {
        $this->tpStatus = $tpStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsurioCancelou()
    {
        return $this->usurioCancelou;
    }

    /**
     * @param mixed $usurioCancelou
     * @return Contrato
     */
    public function setUsurioCancelou($usurioCancelou)
    {
        $this->usurioCancelou = $usurioCancelou;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtCancelamento()
    {
        return $this->dtCancelamento;
    }

    /**
     * @param mixed $dtCancelamento
     * @return Contrato
     */
    public function setDtCancelamento($dtCancelamento)
    {
        $this->dtCancelamento = $dtCancelamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsObervacao()
    {
        return $this->dsObervacao;
    }

    /**
     * @param mixed $dsObervacao
     * @return Contrato
     */
    public function setDsObervacao($dsObervacao)
    {
        $this->dsObervacao = $dsObervacao;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getNrJuros()
    {
        return $this->nrJuros;
    }

    /**
     * @param mixed $nrJuros
     * @return Contrato
     */
    public function setNrJuros($nrJuros)
    {
        $this->nrJuros = $nrJuros;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getPlano()
    {
        return $this->plano;
    }

    /**
     * @param mixed $plano
     * @return Contrato
     */
    public function setPlano(Plano $plano)
    {
        $this->plano = $plano;
        return $this;
    }



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