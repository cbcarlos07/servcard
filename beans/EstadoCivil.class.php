<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:54
 */
class EstadoCivil
{
  private $cdEstadoCivil;
  private $dsEstadoCivil;

    /**
     * @return mixed
     */
    public function getCdEstadoCivil()
    {
        return $this->cdEstadoCivil;
    }

    /**
     * @param mixed $cdEstadoCivil
     * @return EstadoCivil
     */
    public function setCdEstadoCivil($cdEstadoCivil)
    {
        $this->cdEstadoCivil = $cdEstadoCivil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEstadoCivil()
    {
        return $this->dsEstadoCivil;
    }

    /**
     * @param mixed $dsEstadoCivil
     * @return EstadoCivil
     */
    public function setDsEstadoCivil($dsEstadoCivil)
    {
        $this->dsEstadoCivil = $dsEstadoCivil;
        return $this;
    }



}