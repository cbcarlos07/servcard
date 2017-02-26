<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class CarteiraList
{
   private $_carteira;
   private $_carteiraCount;

    /**
     * CarteiraList constructor.
     * @param $_carteira
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getCarteiraCount()
    {
        return $this->_carteiraCount;
    }

    /**
     * @param mixed $carteiraCount
     * @return CarteiraList
     */
    public function setCarteiraCount($newCount)
    {
        $this->_carteiraCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCarteira($_carteiraNumberToGet)
    {
        if((is_numeric($_carteiraNumberToGet)) && ($_carteiraNumberToGet <= $this->getCarteiraCount())){
            return $this->_carteira[$_carteiraNumberToGet];
        }else{
            return null;
        }
    }

    public function addCarteira(Carteira $_carteira_in) {
        $this->setCarteiraCount($this->getCarteiraCount() + 1);
        $this->_carteira[$this->getCarteiraCount()] = $_carteira_in;
        return $this->getCarteiraCount();
    }
    public function removeCarteira(Carteira $_carteira_in) {
        $counter = 0;
        while (++$counter <= $this->getCarteiraCount()) {
            if ($_carteira_in->getAuthorAndTitle() ==
                $this->_carteira[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getCarteiraCount(); $x++) {
                    $this->_carteira[$x] = $this->_carteira[$x + 1];
                }
                $this->setCarteiraCount($this->getCarteiraCount() - 1);
            }
        }
        return $this->getCarteiraCount();
    }


}