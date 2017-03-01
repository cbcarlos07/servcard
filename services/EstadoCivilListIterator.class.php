<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EstadoCivilListIterator
{
    protected $estadoCivilList;
    protected $currentEstadoCivil = 0;

    public function __construct(EstadoCivilList $estadoCivilList_in) {
        $this->estadoCivilList = $estadoCivilList_in;
    }
    public function getCurrentEstadoCivil() {
        if (($this->currentEstadoCivil > 0) &&
            ($this->estadoCivilList->getEstadoCivilCount() >= $this->currentEstadoCivil)) {
            return $this->estadoCivilList->getEstadoCivil($this->currentEstadoCivil);
        }
    }
    public function getNextEstadoCivil() {
        if ($this->hasNextEstadoCivil()) {
            return $this->estadoCivilList->getEstadoCivil(++$this->currentEstadoCivil);
        } else {
            return NULL;
        }
    }
    public function hasNextEstadoCivil() {
        if ($this->estadoCivilList->getEstadoCivilCount() > $this->currentEstadoCivil) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}