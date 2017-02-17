<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 13:37
 */
class Estado
{
  private $cdEstado;
  private $nmEstado;
  private $dsUF;
  private $cdPais;

    /**
     * @return mixed
     */
    public function getCdEstado()
    {
        return $this->cdEstado;
    }

    /**
     * @param mixed $cdEstado
     * @return Estado
     */
    public function setCdEstado($cdEstado)
    {
        $this->cdEstado = $cdEstado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmEstado()
    {
        return $this->nmEstado;
    }

    /**
     * @param mixed $nmEstado
     * @return Estado
     */
    public function setNmEstado($nmEstado)
    {
        $this->nmEstado = $nmEstado;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsUF()
    {
        return $this->dsUF;
    }

    /**
     * @param mixed $dsUF
     * @return Estado
     */
    public function setDsUF($dsUF)
    {
        $this->dsUF = $dsUF;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCdPais()
    {
        return $this->cdPais;
    }

    /**
     * @param mixed $cdPais
     * @return Estado
     */
    public function setCdPais(Pais $cdPais)
    {
        $this->cdPais = $cdPais;
        return $this;
    }


}