<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ContratoList
{
   private $_contrato;
   private $_contratoCount;

    /**
     * ContratoList constructor.
     * @param $_contrato
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getContratoCount()
    {
        return $this->_contratoCount;
    }

    /**
     * @param mixed $contratoCount
     * @return ContratoList
     */
    public function setContratoCount($newCount)
    {
        $this->_contratoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContrato($_contratoNumberToGet)
    {
        if((is_numeric($_contratoNumberToGet)) && ($_contratoNumberToGet <= $this->getContratoCount())){
            return $this->_contrato[$_contratoNumberToGet];
        }else{
            return null;
        }
    }

    public function addContrato(Contrato $_contrato_in) {
        $this->setContratoCount($this->getContratoCount() + 1);
        $this->_contrato[$this->getContratoCount()] = $_contrato_in;
        return $this->getContratoCount();
    }
    public function removeContrato(Contrato $_contrato_in) {
        $counter = 0;
        while (++$counter <= $this->getContratoCount()) {
            if ($_contrato_in->getAuthorAndTitle() ==
                $this->_contrato[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getContratoCount(); $x++) {
                    $this->_contrato[$x] = $this->_contrato[$x + 1];
                }
                $this->setContratoCount($this->getContratoCount() - 1);
            }
        }
        return $this->getContratoCount();
    }


}