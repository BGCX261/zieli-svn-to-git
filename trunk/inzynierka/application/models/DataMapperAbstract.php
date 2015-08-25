<?php

abstract class Model_DataMapperAbstract
{
    private static $_db = null;

    /**
     *
     * @return Zend_Db_Table
     */
    protected function getDb() {
        if (is_null(self::$_db)) {
            self::$_db = Zend_Db_Table::getDefaultAdapter();
        }
        return self::$_db;
    }

    public function save(Model_DomainObjectAbstract $obj) {
        if (is_null($obj->getId())) {
            $this->_insert($obj);
        } else {
            $this->_update($obj);
        }
    }

    abstract protected function _insert(Model_DomainObjectAbstract $obj);

    abstract protected function _update(Model_DomainObjectAbstract $obj);

    abstract protected function _populate($data);

    abstract public static function getInstance();
}