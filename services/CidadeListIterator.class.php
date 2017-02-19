<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class CidadeListIterator
{
    public function addCidade(Cidade $_cidade_in) {
        $this->setCidadeCount($this->getCidadeCount() + 1);
        $this->_cidade[$this->getCidadeCount()] = $_cidade_in;
        return $this->getCidadeCount();
    }
    public function removeCidade(Cidade $_cidade_in) {
        $counter = 0;
        while (++$counter <= $this->getCidadeCount()) {
            if ($_cidade_in->getAuthorAndTitle() ==
                $this->_cidade[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getCidadeCount(); $x++) {
                    $this->_cidade[$x] = $this->_cidade[$x + 1];
                }
                $this->setCidadeCount($this->getCidadeCount() - 1);
            }
        }
        return $this->getCidadeCount();
    }
}