<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class ContaList
{
   private $_conta;
   private $_contaCount;

    /**
     * ContaList constructor.
     * @param $_conta
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getContaCount()
    {
        return $this->_contaCount;
    }

    /**
     * @param mixed $contaCount
     * @return ContaList
     */
    public function setContaCount($newCount)
    {
        $this->_contaCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConta($_contaNumberToGet)
    {
        if((is_numeric($_contaNumberToGet)) && ($_contaNumberToGet <= $this->getContaCount())){
            return $this->_conta[$_contaNumberToGet];
        }else{
            return null;
        }
    }

    public function addConta(Conta $_conta_in) {
        $this->setContaCount($this->getContaCount() + 1);
        $this->_conta[$this->getContaCount()] = $_conta_in;
        return $this->getContaCount();
    }
    public function removeConta(Conta $_conta_in) {
        $counter = 0;
        while (++$counter <= $this->getContaCount()) {
            if ($_conta_in->getAuthorAndTitle() ==
                $this->_conta[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getContaCount(); $x++) {
                    $this->_conta[$x] = $this->_conta[$x + 1];
                }
                $this->setContaCount($this->getContaCount() - 1);
            }
        }
        return $this->getContaCount();
    }


}