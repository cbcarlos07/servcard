<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:06
 */
class Carteira
{
private $cdCarteira;
private $dtValidade;
private $snAtivo;
private $snTitular;
private $cliente;
private $contrato;
private $dtCadatro;
private $dtInativacao;
private $usuario;
private $obsInativacao;

    /**
     * @return mixed
     */
    public function getDtCadatro()
    {
        return $this->dtCadatro;
    }

    /**
     * @param mixed $dtCadatro
     * @return Carteira
     */
    public function setDtCadatro($dtCadatro)
    {
        $this->dtCadatro = $dtCadatro;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtInativacao()
    {
        return $this->dtInativacao;
    }

    /**
     * @param mixed $dtInativacao
     * @return Carteira
     */
    public function setDtInativacao($dtInativacao)
    {
        $this->dtInativacao = $dtInativacao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     * @return Carteira
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getObsInativacao()
    {
        return $this->obsInativacao;
    }

    /**
     * @param mixed $obsInativacao
     * @return Carteira
     */
    public function setObsInativacao($obsInativacao)
    {
        $this->obsInativacao = $obsInativacao;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getCdCarteira()
    {
        return $this->cdCarteira;
    }

    /**
     * @param mixed $cdCarteira
     * @return Carteira
     */
    public function setCdCarteira($cdCarteira)
    {
        $this->cdCarteira = $cdCarteira;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtValidade()
    {
        return $this->dtValidade;
    }

    /**
     * @param mixed $dtValidade
     * @return Carteira
     */
    public function setDtValidade($dtValidade)
    {
        $this->dtValidade = $dtValidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnAtivo()
    {
        return $this->snAtivo;
    }

    /**
     * @param mixed $snAtivo
     * @return Carteira
     */
    public function setSnAtivo($snAtivo)
    {
        $this->snAtivo = $snAtivo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSnTitular()
    {
        return $this->snTitular;
    }

    /**
     * @param mixed $snTitular
     * @return Carteira
     */
    public function setSnTitular($snTitular)
    {
        $this->snTitular = $snTitular;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     * @return Carteira
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
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
     * @return Carteira
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
        return $this;
    }






}