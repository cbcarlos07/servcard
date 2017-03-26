<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:45
 */
class Conta
{
   private $cdConta;
   private $nrAgencia;
   private $nrDigAgencia;
   private $nrConta;
   private $nrDigConta;
   private $nmBanco;
   private $snAtual;
   private $vlTaxaBoleto;
   private $dsSiglaBanco;

    /**
     * @return mixed
     */
    public function getDsSiglaBanco()
    {
        return $this->dsSiglaBanco;
    }

    /**
     * @param mixed $dsSiglaBanco
     * @return Conta
     */
    public function setDsSiglaBanco($dsSiglaBanco)
    {
        $this->dsSiglaBanco = $dsSiglaBanco;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getVlTaxaBoleto()
    {
        return $this->vlTaxaBoleto;
    }

    /**
     * @param mixed $vlTaxaBoleto
     * @return Conta
     */
    public function setVlTaxaBoleto($vlTaxaBoleto)
    {
        $this->vlTaxaBoleto = $vlTaxaBoleto;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCdConta()
    {
        return $this->cdConta;
    }

    /**
     * @param mixed $cdConta
     * @return Conta
     */
    public function setCdConta($cdConta)
    {
        $this->cdConta = $cdConta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrAgencia()
    {
        return $this->nrAgencia;
    }

    /**
     * @param mixed $nrAgencia
     * @return Conta
     */
    public function setNrAgencia($nrAgencia)
    {
        $this->nrAgencia = $nrAgencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrDigAgencia()
    {
        return $this->nrDigAgencia;
    }

    /**
     * @param mixed $nrDigAgencia
     * @return Conta
     */
    public function setNrDigAgencia($nrDigAgencia)
    {
        $this->nrDigAgencia = $nrDigAgencia;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrConta()
    {
        return $this->nrConta;
    }

    /**
     * @param mixed $nfConta
     * @return Conta
     */
    public function setNrConta($nrConta)
    {
        $this->nrConta = $nrConta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrDigConta()
    {
        return $this->nrDigConta;
    }

    /**
     * @param mixed $nrDigConta
     * @return Conta
     */
    public function setNrDigConta($nrDigConta)
    {
        $this->nrDigConta = $nrDigConta;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmBanco()
    {
        return $this->nmBanco;
    }

    /**
     * @param mixed $nmBanco
     * @return Conta
     */
    public function setNmBanco($nmBanco)
    {
        $this->nmBanco = $nmBanco;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnAtual()
    {
        return $this->snAtual;
    }

    /**
     * @param mixed $snAtual
     * @return Conta
     */
    public function setSnAtual($snAtual)
    {
        $this->snAtual = $snAtual;
        return $this;
    }




}