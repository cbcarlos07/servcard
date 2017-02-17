<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class BairroListIterator
{
    public function addBairro(Bairro $_bairro_in) {
        $this->setBairroCount($this->getBairroCount() + 1);
        $this->_bairro[$this->getBairroCount()] = $_bairro_in;
        return $this->getBairroCount();
    }
    public function removeBairro(Bairro $_bairro_in) {
        $counter = 0;
        while (++$counter <= $this->getBairroCount()) {
            if ($_bairro_in->getAuthorAndTitle() ==
                $this->_bairro[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getBairroCount(); $x++) {
                    $this->_bairro[$x] = $this->_bairro[$x + 1];
                }
                $this->setBairroCount($this->getBairroCount() - 1);
            }
        }
        return $this->getBairroCount();
    }
}