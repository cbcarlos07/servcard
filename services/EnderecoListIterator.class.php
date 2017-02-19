<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class EnderecoListIterator
{
    public function addEndereco(Endereco $_endereco_in) {
        $this->setEnderecoCount($this->getEnderecoCount() + 1);
        $this->_endereco[$this->getEnderecoCount()] = $_endereco_in;
        return $this->getEnderecoCount();
    }
    public function removeEndereco(Endereco $_endereco_in) {
        $counter = 0;
        while (++$counter <= $this->getEnderecoCount()) {
            if ($_endereco_in->getAuthorAndTitle() ==
                $this->_endereco[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getEnderecoCount(); $x++) {
                    $this->_endereco[$x] = $this->_endereco[$x + 1];
                }
                $this->setEnderecoCount($this->getEnderecoCount() - 1);
            }
        }
        return $this->getEnderecoCount();
    }
}