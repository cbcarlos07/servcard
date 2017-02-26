<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:59
 */
class Plano
{
  private $cdPlano;
  private $dsPlano;
  private $obsPlano;
  private $nrValor;

    /**
     * @return mixed
     */
    public function getCdPlano()
    {
        return $this->cdPlano;
    }

    /**
     * @param mixed $cdPlano
     * @return Plano
     */
    public function setCdPlano($cdPlano)
    {
        $this->cdPlano = $cdPlano;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsPlano()
    {
        return $this->dsPlano;
    }

    /**
     * @param mixed $dsPlano
     * @return Plano
     */
    public function setDsPlano($dsPlano)
    {
        $this->dsPlano = $dsPlano;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObsPlano()
    {
        return $this->obsPlano;
    }

    /**
     * @param mixed $obsPlano
     * @return Plano
     */
    public function setObsPlano($obsPlano)
    {
        $this->obsPlano = $obsPlano;
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
     * @return Plano
     */
    public function setNrValor($nrValor)
    {
        $this->nrValor = $nrValor;
        return $this;
    }


}