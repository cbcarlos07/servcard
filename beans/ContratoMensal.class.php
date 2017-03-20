<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:18
 */
class ContratoMensal
{
private $contrato;
private $dtVencimento;
private $nrValor;
private $nrParcela;
private $snPago;

    /**
     * @return mixed
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * @param mixed $contrato
     * @return ContratoMensal
     */
    public function setContrato(Contrato $contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getDtVencimento()
    {
        return $this->dtVencimento;
    }

    /**
     * @param mixed $dtVencimento
     * @return ContratoMensal
     */
    public function setDtVencimento($dtVencimento)
    {
        $this->dtVencimento = $dtVencimento;
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
     * @return ContratoMensal
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
     * @return ContratoMensal
     */
    public function setNrParcela($nrParcela)
    {
        $this->nrParcela = $nrParcela;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnPago()
    {
        return $this->snPago;
    }

    /**
     * @param mixed $snPago
     * @return ContratoMensal
     */
    public function setSnPago($snPago)
    {
        $this->snPago = $snPago;
        return $this;
    }



}