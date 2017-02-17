<?php

/**
 * Created by PhpStorm.
 * User: carlos.brito
 * Date: 17/02/2017
 * Time: 14:08
 */
class Cliente
{
private $cdCliente;
private $nmCliente;
private $nrCpf;
private $nrRg;
private $nrTelefone;
private $dsEmail;
private $dtNascimento;
private $tpSexo;
private $estadoCivil;
private $cep;

private $dsSenha;

    /**
     * @return mixed
     */
    public function getCdCliente()
    {
        return $this->cdCliente;
    }

    /**
     * @param mixed $cdCliente
     * @return Cliente
     */
    public function setCdCliente($cdCliente)
    {
        $this->cdCliente = $cdCliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNmCliente()
    {
        return $this->nmCliente;
    }

    /**
     * @param mixed $nmCliente
     * @return Cliente
     */
    public function setNmCliente($nmCliente)
    {
        $this->nmCliente = $nmCliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrCpf()
    {
        return $this->nrCpf;
    }

    /**
     * @param mixed $nrCpf
     * @return Cliente
     */
    public function setNrCpf($nrCpf)
    {
        $this->nrCpf = $nrCpf;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrRg()
    {
        return $this->nrRg;
    }

    /**
     * @param mixed $nrRg
     * @return Cliente
     */
    public function setNrRg($nrRg)
    {
        $this->nrRg = $nrRg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNrTelefone()
    {
        return $this->nrTelefone;
    }

    /**
     * @param mixed $nrTelefone
     * @return Cliente
     */
    public function setNrTelefone($nrTelefone)
    {
        $this->nrTelefone = $nrTelefone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDsEmail()
    {
        return $this->dsEmail;
    }

    /**
     * @param mixed $dsEmail
     * @return Cliente
     */
    public function setDsEmail($dsEmail)
    {
        $this->dsEmail = $dsEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * @param mixed $dtNascimento
     * @return Cliente
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }

    /**
     * @param mixed $tpSexo
     * @return Cliente
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * @param mixed $estadoCivil
     * @return Cliente
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
        return $this;
    }


    /**
     * @param mixed $cep
     * @return Cliente
     */
    public function setCep(Endereco $cep)
    {
        $this->cep = $cep;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getDsSenha()
    {
        return $this->dsSenha;
    }

    /**
     * @param mixed $dsSenha
     * @return Cliente
     */
    public function setDsSenha($dsSenha)
    {
        $this->dsSenha = $dsSenha;
        return $this;
    }


}