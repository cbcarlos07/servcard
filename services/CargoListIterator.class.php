<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CargoListIterator
{
    public function addCargo(Cargo $_cargo_in) {
        $this->setCargoCount($this->getCargoCount() + 1);
        $this->_cargo[$this->getCargoCount()] = $_cargo_in;
        return $this->getCargoCount();
    }
    public function removeCargo(Cargo $_cargo_in) {
        $counter = 0;
        while (++$counter <= $this->getCargoCount()) {
            if ($_cargo_in->getAuthorAndTitle() ==
                $this->_cargo[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getCargoCount(); $x++) {
                    $this->_cargo[$x] = $this->_cargo[$x + 1];
                }
                $this->setCargoCount($this->getCargoCount() - 1);
            }
        }
        return $this->getCargoCount();
    }
}