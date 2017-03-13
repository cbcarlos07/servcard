<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CarteiraListIterator
{
    protected $carteiraList;
    protected $currentCarteira = 0;

    public function __construct(CarteiraList $carteiraList_in) {
        $this->carteiraList = $carteiraList_in;
    }
    public function getCurrentCarteira() {
        if (($this->currentCarteira > 0) &&
            ($this->carteiraList->getCarteiraCount() >= $this->currentCarteira)) {
            return $this->carteiraList->getCarteira($this->currentCarteira);
        }
    }
    public function getNextCarteira() {
        if ($this->hasNextCarteira()) {
            return $this->carteiraList->getCarteira(++$this->currentCarteira);
        } else {
            return NULL;
        }
    }
    public function hasNextCarteira() {
        if ($this->carteiraList->getCarteiraCount() > $this->currentCarteira) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}