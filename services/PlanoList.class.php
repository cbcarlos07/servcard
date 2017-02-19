<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class PlanoList
{
   private $_plano;
   private $_planoCount;

    /**
     * PlanoList constructor.
     * @param $_plano
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getPlanoCount()
    {
        return $this->_planoCount;
    }

    /**
     * @param mixed $planoCount
     * @return PlanoList
     */
    public function setPlanoCount($newCount)
    {
        $this->_planoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlano($_planoNumberToGet)
    {
        if((is_numeric($_planoNumberToGet)) && ($_planoNumberToGet <= $this->getPlanoCount())){
            return $this->_plano[$_planoNumberToGet];
        }else{
            return null;
        }
    }

    public function addPlano(Plano $_plano_in) {
        $this->setPlanoCount($this->getPlanoCount() + 1);
        $this->_plano[$this->getPlanoCount()] = $_plano_in;
        return $this->getPlanoCount();
    }
    public function removePlano(Plano $_plano_in) {
        $counter = 0;
        while (++$counter <= $this->getPlanoCount()) {
            if ($_plano_in->getAuthorAndTitle() ==
                $this->_plano[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getPlanoCount(); $x++) {
                    $this->_plano[$x] = $this->_plano[$x + 1];
                }
                $this->setPlanoCount($this->getPlanoCount() - 1);
            }
        }
        return $this->getPlanoCount();
    }


}