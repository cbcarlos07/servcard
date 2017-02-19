<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ZonaListIterator
{
    public function addZona(Zona $_zona_in) {
        $this->setZonaCount($this->getZonaCount() + 1);
        $this->_zona[$this->getZonaCount()] = $_zona_in;
        return $this->getZonaCount();
    }
    public function removeZona(Zona $_zona_in) {
        $counter = 0;
        while (++$counter <= $this->getZonaCount()) {
            if ($_zona_in->getAuthorAndTitle() ==
                $this->_zona[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getZonaCount(); $x++) {
                    $this->_zona[$x] = $this->_zona[$x + 1];
                }
                $this->setZonaCount($this->getZonaCount() - 1);
            }
        }
        return $this->getZonaCount();
    }
}