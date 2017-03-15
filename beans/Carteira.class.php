<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:06
 */
class Carteira
{
private $cdCarteira;
private $dtValidade;
private $snAtivo;
private $tpTitular;
private $cliente;

private $contrato;








    /**
     * @return mixed
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * @param mixed $contrato
     * @return Carteira
     */
    public function setContrato(Contrato $contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCdCarteira()
    {
        return $this->cdCarteira;
    }

    /**
     * @param mixed $cdCarteira
     * @return Carteira
     */
    public function setCdCarteira($cdCarteira)
    {
        $this->cdCarteira = $cdCarteira;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtValidade()
    {
        return $this->dtValidade;
    }

    /**
     * @param mixed $dtValidade
     * @return Carteira
     */
    public function setDtValidade($dtValidade)
    {
        $this->dtValidade = $dtValidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->snAtivo;
    }

    /**
     * @param mixed $snAtivo
     * @return Carteira
     */
    public function setSnAtivo($snAtivo)
    {
        $this->snAtivo = $snAtivo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTpTitular()
    {
        return $this->tpTitular;
    }

    /**
     * @param mixed $tpTitular
     * @return Carteira
     */
    public function setTpTitular($tpTitular)
    {
        $this->tpTitular = $tpTitular;
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
     * @return Carteira
     */
    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }



}