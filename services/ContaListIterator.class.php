<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ContaListIterator
{
    protected $contaList;
    protected $currentConta = 0;

    public function __construct(ContaList $contaList_in) {
        $this->contaList = $contaList_in;
    }
    public function getCurrentConta() {
        if (($this->currentConta > 0) &&
            ($this->contaList->getContaCount() >= $this->currentConta)) {
            return $this->contaList->getConta($this->currentConta);
        }
    }
    public function getNextConta() {
        if ($this->hasNextConta()) {
            return $this->contaList->getConta(++$this->currentConta);
        } else {
            return NULL;
        }
    }
    public function hasNextConta() {
        if ($this->contaList->getContaCount() > $this->currentConta) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}