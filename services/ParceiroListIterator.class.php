<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ParceiroListIterator
{
    public function addParceiro(Parceiro $_parceiro_in) {
        $this->setParceiroCount($this->getParceiroCount() + 1);
        $this->_parceiro[$this->getParceiroCount()] = $_parceiro_in;
        return $this->getParceiroCount();
    }
    public function removeParceiro(Parceiro $_parceiro_in) {
        $counter = 0;
        while (++$counter <= $this->getParceiroCount()) {
            if ($_parceiro_in->getAuthorAndTitle() ==
                $this->_parceiro[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getParceiroCount(); $x++) {
                    $this->_parceiro[$x] = $this->_parceiro[$x + 1];
                }
                $this->setParceiroCount($this->getParceiroCount() - 1);
            }
        }
        return $this->getParceiroCount();
    }
}