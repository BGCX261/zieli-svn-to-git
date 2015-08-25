<?php

class Model_UserMapper extends Model_DataMapperAbstract
{
    private static $_instance = null;

    public function daneUzytkownika($id)
    {
        $db = $this->getDb();
        $select = $db->select()->from('users')
                               ->where('id = ?', $id);

        $data = $db->fetchRow($select);
        return $this->_populate($data);
    }

    protected function _insert(Model_DomainObjectAbstract $obj) {
        $db = $this->getDb();
        $data = array(
            'username'  => $obj->getUsername(),
            'password'  => $obj->getPassword(),
            'firstname' => $obj->getFirstname(),
            'lastname'  => $obj->getLastname(),
            'email'     => $obj->getEmail()
        );

        $db->insert('users', $data);
    }

    protected function _populate($data) {
        $obj = new Model_User();

        $obj->setId($data['id']);
        $obj->setUsername($data['username']);
        $obj->setFirstname($data['firstname']);
        $obj->setLastname($dane['lastname']);
        $obj->setEmail($dane['email']);
        $obj->setPassword($dane['password']);

        return $obj;
    }

    protected function _update(Model_DomainObjectAbstract $obj) {

    }

    /**
     *
     * @return Model_UsersMapper
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