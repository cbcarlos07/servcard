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
private $nmSobrenome;
private $nrCpf;
private $nrRg;
private $nrTelefone;
private $dsEmail;
private $dtNascimento;
private $tpSexo;
private $estadoCivil;
private $nrCep;
private $bairro;
private $nrCasa;
private $dsComplemento;
private $dsSenha;
private $snSenhaAtual;
private $dtCadastro;

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
    public function getNmSobrenome()
    {
        return $this->nmSobrenome;
    }

    /**
     * @param mixed $nmSobrenome
     * @return Cliente
     */
    public function setNmSobrenome($nmSobrenome)
    {
        $this->nmSobrenome = $nmSobrenome;
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
     * @return mixed
     */
    public function getNrCep()
    {
        return $this->nrCep;
    }

    /**
     * @param mixed $nrCep
     * @return Cliente
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
     * @return Cliente
     */
    public function setBairro(Bairro $bairro)
    {
        $this->bairro = $bairro;
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
     * @return Cliente
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
     * @return Cliente
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
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

    /**
     * @return mixed
     */
    public function getSnSenhaAtual()
    {
        return $this->snSenhaAtual;
    }

    /**
     * @param mixed $snSenhaAtual
     * @return Cliente
     */
    public function setSnSenhaAtual($snSenhaAtual)
    {
        $this->snSenhaAtual = $snSenhaAtual;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDtCadastro()
    {
        return $this->dtCadastro;
    }

    /**
     * @param mixed $dtCadastro
     * @return Cliente
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }


}