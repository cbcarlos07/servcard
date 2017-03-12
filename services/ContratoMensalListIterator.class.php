<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ContratoMensalListIterator
{
    protected $contratoMensalList;
    protected $currentContratoMensal = 0;

    public function __construct(ContratoMensalList $contratoMensalList_in) {
        $this->contratoMensalList = $contratoMensalList_in;
    }
    public function getCurrentContratoMensal() {
        if (($this->currentContratoMensal > 0) &&
            ($this->contratoMensalList->getContratoMensalCount() >= $this->currentContratoMensal)) {
            return $this->contratoMensalList->getContratoMensal($this->currentContratoMensal);
        }
    }
    public function getNextContratoMensal() {
        if ($this->hasNextContratoMensal()) {
            return $this->contratoMensalList->getContratoMensal(++$this->currentContratoMensal);
        } else {
            return NULL;
        }
    }
    public function hasNextContratoMensal() {
        if ($this->contratoMensalList->getContratoMensalCount() > $this->currentContratoMensal) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}