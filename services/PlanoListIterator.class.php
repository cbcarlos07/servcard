<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class PlanoListIterator
{
    public function addPlano(Plano $_plano_in) {
        $this->setPlanoCount($this->getPlanoCount() + 1);
        $this->_plano[$this->getPlanoCount()] = $_plano_in;
        return $this->getPlanoCount();
    }
    public function removePlano(Plano $_plano_in) {
        $counter = 0;
        while (++$counter <= $this->getPlanoCount()) {
            if ($_plano_in->getAuthorAndTitle() ==
                $this->_plano[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getPlanoCount(); $x++) {
                    $this->_plano[$x] = $this->_plano[$x + 1];
                }
                $this->setPlanoCount($this->getPlanoCount() - 1);
            }
        }
        return $this->getPlanoCount();
    }
}