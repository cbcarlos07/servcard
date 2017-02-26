<?php

/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 17/02/17
 * Time: 17:02
 */
class UsuarioListIterator
{
    public function addUsuario(Usuario $_usuario_in) {
        $this->setUsuarioCount($this->getUsuarioCount() + 1);
        $this->_usuario[$this->getUsuarioCount()] = $_usuario_in;
        return $this->getUsuarioCount();
    }
    public function removeUsuario(Usuario $_usuario_in) {
        $counter = 0;
        while (++$counter <= $this->getUsuarioCount()) {
            if ($_usuario_in->getAuthorAndTitle() ==
                $this->_usuario[$counter]->getAuthorAndTitle())
            {
                for ($x = $counter; $x < $this->getUsuarioCount(); $x++) {
                    $this->_usuario[$x] = $this->_usuario[$x + 1];
                }
                $this->setUsuarioCount($this->getUsuarioCount() - 1);
            }
        }
        return $this->getUsuarioCount();
    }
}