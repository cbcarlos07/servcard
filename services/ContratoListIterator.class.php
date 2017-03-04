<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ContratoListIterator
{
    protected $contratoList;
    protected $currentContrato = 0;

    public function __construct(ContratoList $contratoList_in) {
        $this->contratoList = $contratoList_in;
    }
    public function getCurrentContrato() {
        if (($this->currentContrato > 0) &&
            ($this->contratoList->getContratoCount() >= $this->currentContrato)) {
            return $this->contratoList->getContrato($this->currentContrato);
        }
    }
    public function getNextContrato() {
        if ($this->hasNextContrato()) {
            return $this->contratoList->getContrato(++$this->currentContrato);
        } else {
            return NULL;
        }
    }
    public function hasNextContrato() {
        if ($this->contratoList->getContratoCount() > $this->currentContrato) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}