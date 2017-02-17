<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:54
 */
class Estado_Civil
{
  private $cd_Estado_Civil;
  private $ds_Estado_Civil;

    /**
     * @return mixed
     */
    public function getCdEstadoCivil()
    {
        return $this->cd_Estado_Civil;
    }

    /**
     * @param mixed $cd_Estado_Civil
     * @return Estado_Civil
     */
    public function setCdEstadoCivil($cd_Estado_Civil)
    {
        $this->cd_Estado_Civil = $cd_Estado_Civil;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEstadoCivil()
    {
        return $this->ds_Estado_Civil;
    }

    /**
     * @param mixed $ds_Estado_Civil
     * @return Estado_Civil
     */
    public function setDsEstadoCivil($ds_Estado_Civil)
    {
        $this->ds_Estado_Civil = $ds_Estado_Civil;
        return $this;
    }



}