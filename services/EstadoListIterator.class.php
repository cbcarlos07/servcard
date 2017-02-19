<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EstadoListIterator
{
    public function addEstado(Estado $_estado_in) {
        $this->setEstadoCount($this->getEstadoCount() + 1);
        $this->_estado[$this->getEstadoCount()] = $_estado_in;
        return $this->getEstadoCount();
    }
    public function removeEstado(Estado $_estado_in) {
        $counter = 0;
        while (++$counter <= $this->getEstadoCount()) {
            if ($_estado_in->getAuthorAndTitle() ==
                $this->_estado[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEstadoCount(); $x++) {
                    $this->_estado[$x] = $this->_estado[$x + 1];
                }
                $this->setEstadoCount($this->getEstadoCount() - 1);
            }
        }
        return $this->getEstadoCount();
    }
}