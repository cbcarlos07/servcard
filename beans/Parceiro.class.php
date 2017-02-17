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
    public function setNrCep(Endereco $nrCep)
    {
        $this->nrCep = $nrCep;
        return $this;
    }


}