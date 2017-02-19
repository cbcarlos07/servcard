<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ContratoMensalListIterator
{
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