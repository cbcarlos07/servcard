<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 16:49
 */
class PagamentoList
{
   private $_pagamento;
   private $_pagamentoCount;

    /**
     * PagamentoList constructor.
     * @param $_pagamento
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getPagamentoCount()
    {
        return $this->_pagamentoCount;
    }

    /**
     * @param mixed $pagamentoCount
     * @return PagamentoList
     */
    public function setPagamentoCount($newCount)
    {
        $this->_pagamentoCount = $newCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPagamento($_pagamentoNumberToGet)
    {
        if((is_numeric($_pagamentoNumberToGet)) && ($_pagamentoNumberToGet <= $this->getPagamentoCount())){
            return $this->_pagamento[$_pagamentoNumberToGet];
        }else{
            return null;
        }
    }

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