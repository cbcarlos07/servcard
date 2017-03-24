<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ParceiroListIterator
{
    protected $parceiroList;
    protected $currentParceiro = 0;

    public function __construct(ParceiroList $parceiroList_in) {
        $this->parceiroList = $parceiroList_in;
    }
    public function getCurrentParceiro() {
        if (($this->currentParceiro > 0) &&
            ($this->parceiroList->getParceiroCount() >= $this->currentParceiro)) {
            return $this->parceiroList->getParceiro($this->currentParceiro);
        }
    }
    public function getNextParceiro() {
        if ($this->hasNextParceiro()) {
            return $this->parceiroList->getParceiro(++$this->currentParceiro);
        } else {
            return NULL;
        }
    }
    public function hasNextParceiro() {
        if ($this->parceiroList->getParceiroCount() > $this->currentParceiro) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}