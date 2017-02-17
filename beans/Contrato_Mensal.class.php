<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:18
 */
class Contrato_Mensal
{
private $cdContrato;
private $dtVencimento;
private $nrValor;
private $nrParcela;
private $tpStatus;

    /**
     * @return mixed
     */
    public function getCdContrato()
    {
        return $this->cdContrato;
    }

    /**
     * @param mixed $cdContrato
     * @return Contrato_Mensal
     */
    public function setCdContrato($cdContrato)
    {
        $this->cdContrato = $cdContrato;
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
     * @return Contrato_Mensal
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
     * @return Contrato_Mensal
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
     * @return Contrato_Mensal
     */
    public function setNrParcela($nrParcela)
    {
        $this->nrParcela = $nrParcela;
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
     * @return Contrato_Mensal
     */
    public function setTpStatus($tpStatus)
    {
        $this->tpStatus = $tpStatus;
        return $this;
    }


}