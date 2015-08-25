<?php
class Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;

    public function  __construct(Zend_Acl $_acl) {
        $this->_acl = $_acl;
    }

    public function  preDispatch(Zend_Controller_Request_Abstract $request) {
        $resource = $request->getControllerName();
        $action = $request->getActionName();

        //super ten flash przez niego trzeba kombinować.. ehh
        if (($resource == 'zdjecia') && ($action == 'katalogowanie')) {
            Zend_Registry::set('role', 'zalogowany');
        }

        if (!$this->_acl->isAllowed(Zend_Registry::get('role'), $resource, $action)) {
            $request->setControllerName('autentykacja')
                    ->setActionName('logowanie');
        }
    }
}