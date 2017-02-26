<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class PagamentoListIterator
{
    public function addPagamento(Pagamento $_pagamento_in) {
        $this->setPagamentoCount($this->getPagamentoCount() + 1);
        $this->_pagamento[$this->getPagamentoCount()] = $_pagamento_in;
        return $this->getPagamentoCount();
    }
    public function removePagamento(Pagamento $_pagamento_in) {
        $counter = 0;
        while (++$counter <= $this->getPagamentoCount()) {
            if ($_pagamento_in->getAuthorAndTitle() ==
                $this->_pagamento[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getPagamentoCount(); $x++) {
                    $this->_pagamento[$x] = $this->_pagamento[$x + 1];
                }
                $this->setPagamentoCount($this->getPagamentoCount() - 1);
            }
        }
        return $this->getPagamentoCount();
    }
}