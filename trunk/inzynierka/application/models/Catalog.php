<?php
/**
 * Description of Catalog
 *
 * @author zieli
 */
class Model_Catalog extends Model_DomainObjectAbstract
{
    protected $_name = null;
    protected $_path = null;
    protected $_date = null;
    protected $_users_id = null;

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function getPath() {
        return $this->_path;
    }

    public function setPath($path) {
        $this->_path = $path;
    }

    public function getDate() {
        return $this->_date;
    }

    public function setDate($date) {
        $this->_date = $date;
    }

    public function getUsersId() {
        return $this->_users_id;
    }

    public function setUsersId($usersId) {
        $this->_users_id = $usersId;
    }

}