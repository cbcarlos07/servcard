<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class ClienteListIterator
{
    public function addCliente(Cliente $_cliente_in) {
        $this->setClienteCount($this->getClienteCount() + 1);
        $this->_cliente[$this->getClienteCount()] = $_cliente_in;
        return $this->getClienteCount();
    }
    public function removeCliente(Cliente $_cliente_in) {
        $counter = 0;
        while (++$counter <= $this->getClienteCount()) {
            if ($_cliente_in->getAuthorAndTitle() ==
                $this->_cliente[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getClienteCount(); $x++) {
                    $this->_cliente[$x] = $this->_cliente[$x + 1];
                }
                $this->setClienteCount($this->getClienteCount() - 1);
            }
        }
        return $this->getClienteCount();
    }
}