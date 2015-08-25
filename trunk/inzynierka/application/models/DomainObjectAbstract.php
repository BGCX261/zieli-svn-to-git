<?php

abstract class Model_DomainObjectAbstract
{
    private $_id = null;

    public function setId($id) {
        if (!is_null($this->_id)) {
            throw new Exception('ID jest niemodyfikowalne!');
        }
        $this->_id = $id;
    }

    public function getId() {
        return $this->_id;
    }

}