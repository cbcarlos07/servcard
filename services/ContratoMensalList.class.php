<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ContratoMensalList
{
   private $_contratoMensal;
   private $_contratoMensalCount;

    /**
     * ContratoMensalList constructor.
     * @param $_contratoMensal
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getContratoMensalCount()
    {
        return $this->_contratoMensalCount;
    }

    /**
     * @param mixed $contratoMensalCount
     * @return ContratoMensalList
     */
    public function setContratoMensalCount($newCount)
    {
        $this->_contratoMensalCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContratoMensal($_contratoMensalNumberToGet)
    {
        if((is_numeric($_contratoMensalNumberToGet)) && ($_contratoMensalNumberToGet <= $this->getContratoMensalCount())){
            return $this->_contratoMensal[$_contratoMensalNumberToGet];
        }else{
            return null;
        }
    }

    public function addContratoMensal(ContratoMensal $_contratoMensal_in) {
        $this->setContratoMensalCount($this->getContratoMensalCount() + 1);
        $this->_contratoMensal[$this->getContratoMensalCount()] = $_contratoMensal_in;
        return $this->getContratoMensalCount();
    }
    public function removeContratoMensal(ContratoMensal $_contratoMensal_in) {
        $counter = 0;
        while (++$counter <= $this->getContratoMensalCount()) {
            if ($_contratoMensal_in->getAuthorAndTitle() ==
                $this->_contratoMensal[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getContratoMensalCount(); $x++) {
                    $this->_contratoMensal[$x] = $this->_contratoMensal[$x + 1];
                }
                $this->setContratoMensalCount($this->getContratoMensalCount() - 1);
            }
        }
        return $this->getContratoMensalCount();
    }


}