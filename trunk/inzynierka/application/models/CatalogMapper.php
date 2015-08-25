<?php

class Model_CatalogMapper extends Model_DataMapperAbstract
{
    private static $_instance = null;

    public function listaKatalogow($id_uzytkownika)
    {
        $db = $this->getDb();
        $select = $db->select()->from('catalogs')
                               ->where('users_id = ?', $id_uzytkownika)
                               ->order('name');

        $data = $db->fetchAll($select);
        $tab = array();
        foreach ($data as $da){
            $tab[] = $this->_populate($da);
        }
        return $tab;
    }

    public function katalog($id_katalogu)
    {
        $db = $this->getDb();
        $select = $db->select()
                     ->from('catalogs')
                     ->where('id = ?', $id_katalogu);

        $data = $db->fetchRow($select);
        return $this->_populate($data);
    }

    public function sprawdzNazwe($id, $nazwa)
    {
        $db = $this->getDb();
        $select = $db->select()->from('catalogs')
                               ->where('users_id = ?', $id)
                               ->where('name = ?', $nazwa);

        $data = $db->fetchRow($select);
        return $data;
    }

    /**
     * Funkcja zwracająca id katalogu
     * @param <type> $nazwa
     * @param <type> $id_uzytkownika
     * @return <type> id katalogu
     */
    public function znajdzId($nazwa, $id_uzytkownika)
    {
        $db = $this->getDb();
        $select = $db->select()
                     ->from(array('c' => 'catalogs'),
                            array('id'))
                     ->where('name = ?', $nazwa)
                     ->where('users_id = ?', $id_uzytkownika);

        $data = $db->fetchRow($select);
        $id = $data['id'];
        return $id;
    }

    protected function _insert(Model_DomainObjectAbstract $obj) {
        $db = $this->getDb();
        $data = array(
            'name'     => $obj->getName(),
            'path'     => $obj->getPath(),
            'users_id' => $obj->getUsersId()
        );

        $db->insert('catalogs', $data);
    }

    protected function _populate($data) {
        $obj = new Model_Catalog();

        $obj->setId($data['id']);
        $obj->setName($data['name']);
        $obj->setPath($data['path']);
        $obj->setDate($data['date']);
        $obj->setUsersId($data['users_id']);

        return $obj;
    }

    protected function _update(Model_DomainObjectAbstract $obj) {
        $db = $this->getDb();
        $data = array(
            'name'     => $obj->getName(),
            'path'     => $obj->getPath(),
            'users_id' => $obj->getUsersId()
        );

        $where = $db->quoteInto('id = ?', $obj->getId());
        $db->update('catalogs', $data, $where);
    }

    public function delete($id)
    {
        $db = $this->getDb();
        $where = $db->quoteInto('id = ?', $id);
        $db->delete('catalogs', $where);
    }

    /**
     *
     * @return Model_CatalogMapper
     */
    public static function getInstance()
    {
            if (is_null(self::$_instance)) {
                    $c = __CLASS__;
                    self::$_instance = new $c();
            }
            return self::$_instance;
    }

}