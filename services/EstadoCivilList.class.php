<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class EstadoCivilList
{
   private $_estadoCivil;
   private $_estadoCivilCount;

    /**
     * EstadoCivilList constructor.
     * @param $_estadoCivil
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getEstadoCivilCount()
    {
        return $this->_estadoCivilCount;
    }

    /**
     * @param mixed $estadoCivilCount
     * @return EstadoCivilList
     */
    public function setEstadoCivilCount($newCount)
    {
        $this->_estadoCivilCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadoCivil($_estadoCivilNumberToGet)
    {
        if((is_numeric($_estadoCivilNumberToGet)) && ($_estadoCivilNumberToGet <= $this->getEstadoCivilCount())){
            return $this->_estadoCivil[$_estadoCivilNumberToGet];
        }else{
            return null;
        }
    }

    public function addEstadoCivil(EstadoCivil $_estadoCivil_in) {
        $this->setEstadoCivilCount($this->getEstadoCivilCount() + 1);
        $this->_estadoCivil[$this->getEstadoCivilCount()] = $_estadoCivil_in;
        return $this->getEstadoCivilCount();
    }
    public function removeEstadoCivil(EstadoCivil $_estadoCivil_in) {
        $counter = 0;
        while (++$counter <= $this->getEstadoCivilCount()) {
            if ($_estadoCivil_in->getAuthorAndTitle() ==
                $this->_estadoCivil[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEstadoCivilCount(); $x++) {
                    $this->_estadoCivil[$x] = $this->_estadoCivil[$x + 1];
                }
                $this->setEstadoCivilCount($this->getEstadoCivilCount() - 1);
            }
        }
        return $this->getEstadoCivilCount();
    }


}