<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class PlanoListIterator
{
    protected $planoList;
    protected $currentPlano = 0;

    public function __construct(PlanoList $planoList_in) {
        $this->planoList = $planoList_in;
    }
    public function getCurrentPlano() {
        if (($this->currentPlano > 0) &&
            ($this->planoList->getPlanoCount() >= $this->currentPlano)) {
            return $this->planoList->getPlano($this->currentPlano);
        }
    }
    public function getNextPlano() {
        if ($this->hasNextPlano()) {
            return $this->planoList->getPlano(++$this->currentPlano);
        } else {
            return NULL;
        }
    }
    public function hasNextPlano() {
        if ($this->planoList->getPlanoCount() > $this->currentPlano) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}