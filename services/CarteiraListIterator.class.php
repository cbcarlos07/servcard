<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CarteiraListIterator
{
    public function addCarteira(Carteira $_carteira_in) {
        $this->setCarteiraCount($this->getCarteiraCount() + 1);
        $this->_carteira[$this->getCarteiraCount()] = $_carteira_in;
        return $this->getCarteiraCount();
    }
    public function removeCarteira(Carteira $_carteira_in) {
        $counter = 0;
        while (++$counter <= $this->getCarteiraCount()) {
            if ($_carteira_in->getAuthorAndTitle() ==
                $this->_carteira[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getCarteiraCount(); $x++) {
                    $this->_carteira[$x] = $this->_carteira[$x + 1];
                }
                $this->setCarteiraCount($this->getCarteiraCount() - 1);
            }
        }
        return $this->getCarteiraCount();
    }
}