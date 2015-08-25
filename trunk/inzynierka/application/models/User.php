<?php

class Model_User extends Model_DomainObjectAbstract
{
    protected $_id = null;
    protected $_username = null;
    protected $_password = null;
    protected $_email = null;
    protected $_firstname = null;
    protected $_lastname = null;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function getFirstname() {
        return $this->_firstname;
    }

    public function setFirstname($firstname) {
        $this->_firstname = $firstname;
    }

    public function getLastname() {
        return $this->_lastname;
    }

    public function setLastname($lastname) {
        $this->_lastname = $lastname;
    }
}