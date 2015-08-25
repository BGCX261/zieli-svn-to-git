<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    private $_acl = null;

    protected function _initAutoload()
    {
        if (Zend_Auth::getInstance()->hasIdentity()) {
            Zend_Registry::set('role', 'zalogowany');
        } else {
            Zend_Registry::set('role', 'gosc');
        }

        $this->_acl = new Model_Acl();

        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Plugin_AccessCheck($this->_acl));
    }

    protected function _initViewHelpers()
    {
        $view = new Zend_View();
        ZendX_JQuery::enableView($view);
        $viewrenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewrenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewrenderer);

        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $view->doctype('XHTML1_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8')
                         ->appendName('description', 'Program do katalogowania zdjęć.');
        $view->headTitle('Praca dyplomowa');
    }

    protected function _initLogs()
    {
        $logger = new Zend_Log();
        $fireBugWriter = new Zend_Log_Writer_Firebug();
        $logger->addWriter($fireBugWriter);
        Zend_Registry::set('logger', $logger);
    }

    protected function _initTranslate()
    {
        $language = 'pl';
        $translator = new Zend_Translate(array(
            'adapter' => 'array',
            'content' => APPLICATION_PATH . '/resources/languages/',
            'locale' => $language,
            'scan' => Zend_Translate::LOCALE_DIRECTORY
        ));
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }

}