<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:31
 */
class Pagamento
{
private $cdPagamento;
private $dtPagamento;
private $hrPagamento;
private $vlPagamento;
private $dtVencimento;
private $contrato;

    /**
     * @return mixed
     */
    public function getCdPagamento()
    {
        return $this->cdPagamento;
    }

    /**
     * @param mixed $cdPagamento
     * @return Pagamento
     */
    public function setCdPagamento($cdPagamento)
    {
        $this->cdPagamento = $cdPagamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtPagamento()
    {
        return $this->dtPagamento;
    }

    /**
     * @param mixed $dtPagamento
     * @return Pagamento
     */
    public function setDtPagamento($dtPagamento)
    {
        $this->dtPagamento = $dtPagamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHrPagamento()
    {
        return $this->hrPagamento;
    }

    /**
     * @param mixed $hrPagamento
     * @return Pagamento
     */
    public function setHrPagamento($hrPagamento)
    {
        $this->hrPagamento = $hrPagamento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVlPagamento()
    {
        return $this->vlPagamento;
    }

    /**
     * @param mixed $vlPagamento
     * @return Pagamento
     */
    public function setVlPagamento($vlPagamento)
    {
        $this->vlPagamento = $vlPagamento;
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
     * @return Pagamento
     */
    public function setDtVencimento($dtVencimento)
    {
        $this->dtVencimento = $dtVencimento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * @param mixed $contrato
     * @return Pagamento
     */
    public function setContrato(Contrato $contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }

}