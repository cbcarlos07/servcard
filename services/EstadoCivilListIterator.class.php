<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EstadoCivilListIterator
{
    public function addEstadoCivil(EstadoCivil $_estadoCivil_in) {
        $this->setEstadoCivilCount($this->getEstadoCivilCount() + 1);
        $this->_estadoCivil[$this->getEstadoCivilCount()] = $_estadoCivil_in;
        return $this->getEstadoCivilCount();
    }
    public function removeEstadoCivil(EstadoCivil $_estadoCivil_in) {
        $counter = 0;
        while (++$counter <= $this->getEstadoCivilCount()) {
            if ($_estadoCivil_in->getAuthorAndTitle() ==
                $this->_estadoCivil[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEstadoCivilCount(); $x++) {
                    $this->_estadoCivil[$x] = $this->_estadoCivil[$x + 1];
                }
                $this->setEstadoCivilCount($this->getEstadoCivilCount() - 1);
            }
        }
        return $this->getEstadoCivilCount();
    }
}