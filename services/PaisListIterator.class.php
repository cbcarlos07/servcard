<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class PaisListIterator
{
    public function addPais(Pais $_pais_in) {
        $this->setPaisCount($this->getPaisCount() + 1);
        $this->_pais[$this->getPaisCount()] = $_pais_in;
        return $this->getPaisCount();
    }
    public function removePais(Pais $_pais_in) {
        $counter = 0;
        while (++$counter <= $this->getPaisCount()) {
            if ($_pais_in->getAuthorAndTitle() ==
                $this->_pais[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getPaisCount(); $x++) {
                    $this->_pais[$x] = $this->_pais[$x + 1];
                }
                $this->setPaisCount($this->getPaisCount() - 1);
            }
        }
        return $this->getPaisCount();
    }
}