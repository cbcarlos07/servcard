<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ParceiroList
{
   private $_parceiro;
   private $_parceiroCount;

    /**
     * ParceiroList constructor.
     * @param $_parceiro
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getParceiroCount()
    {
        return $this->_parceiroCount;
    }

    /**
     * @param mixed $parceiroCount
     * @return ParceiroList
     */
    public function setParceiroCount($newCount)
    {
        $this->_parceiroCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParceiro($_parceiroNumberToGet)
    {
        if((is_numeric($_parceiroNumberToGet)) && ($_parceiroNumberToGet <= $this->getParceiroCount())){
            return $this->_parceiro[$_parceiroNumberToGet];
        }else{
            return null;
        }
    }

    public function addParceiro(Parceiro $_parceiro_in) {
        $this->setParceiroCount($this->getParceiroCount() + 1);
        $this->_parceiro[$this->getParceiroCount()] = $_parceiro_in;
        return $this->getParceiroCount();
    }
    public function removeParceiro(Parceiro $_parceiro_in) {
        $counter = 0;
        while (++$counter <= $this->getParceiroCount()) {
            if ($_parceiro_in->getAuthorAndTitle() ==
                $this->_parceiro[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getParceiroCount(); $x++) {
                    $this->_parceiro[$x] = $this->_parceiro[$x + 1];
                }
                $this->setParceiroCount($this->getParceiroCount() - 1);
            }
        }
        return $this->getParceiroCount();
    }


}