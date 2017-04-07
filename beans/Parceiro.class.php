<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:03
 */
class Parceiro
{
   private $cdParceiro;
   private $nmParceiro;
   private $dsResponsavel;
   private $nrCpfResponsavel;
   private $NrCnpj;
   private $nrCep;
   private $bairro;
   private $dsRamo;
   private $nrCasa;
   private $dsComplemento;

    /**
     * @return mixed
     */
    public function getCdParceiro()
    {
        return $this->cdParceiro;
    }

    /**
     * @param mixed $cdParceiro
     * @return Parceiro
     */
    public function setCdParceiro($cdParceiro)
    {
        $this->cdParceiro = $cdParceiro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmParceiro()
    {
        return $this->nmParceiro;
    }

    /**
     * @param mixed $nmParceiro
     * @return Parceiro
     */
    public function setNmParceiro($nmParceiro)
    {
        $this->nmParceiro = $nmParceiro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsResponsavel()
    {
        return $this->dsResponsavel;
    }

    /**
     * @param mixed $dsResponsavel
     * @return Parceiro
     */
    public function setDsResponsavel($dsResponsavel)
    {
        $this->dsResponsavel = $dsResponsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCpfResponsavel()
    {
        return $this->nrCpfResponsavel;
    }

    /**
     * @param mixed $nrCpfResponsavel
     * @return Parceiro
     */
    public function setNrCpfResponsavel($nrCpfResponsavel)
    {
        $this->nrCpfResponsavel = $nrCpfResponsavel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCnpj()
    {
        return $this->NrCnpj;
    }

    /**
     * @param mixed $NrCnpj
     * @return Parceiro
     */
    public function setNrCnpj($NrCnpj)
    {
        $this->NrCnpj = $NrCnpj;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCep()
    {
        return $this->nrCep;
    }

    /**
     * @param mixed $nrCep
     * @return Parceiro
     */
    public function setNrCep($nrCep)
    {
        $this->nrCep = $nrCep;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * @param mixed $bairro
     * @return Parceiro
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsRamo()
    {
        return $this->dsRamo;
    }

    /**
     * @param mixed $dsRamo
     * @return Parceiro
     */
    public function setDsRamo($dsRamo)
    {
        $this->dsRamo = $dsRamo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCasa()
    {
        return $this->nrCasa;
    }

    /**
     * @param mixed $nrCasa
     * @return Parceiro
     */
    public function setNrCasa($nrCasa)
    {
        $this->nrCasa = $nrCasa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsComplemento()
    {
        return $this->dsComplemento;
    }

    /**
     * @param mixed $dsComplemento
     * @return Parceiro
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
        return $this;
    }


}