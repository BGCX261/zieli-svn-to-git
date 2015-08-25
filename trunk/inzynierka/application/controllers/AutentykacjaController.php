<?php
/**
 * Zarządzanie dostępem:
 * logowanie, wylogowywanie
 *
 */
class AutentykacjaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    private function getAuthAdapter()
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('MD5(?)');

        return $authAdapter;
    }

    public function logowanieAction()
    {
        $this->view->title = 'Logowanie';

        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/');
        }

        $request = $this->getRequest();
        $form = new Form_Login();
        if ($request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $authAdapter = $this->getAuthAdapter();

                $username = $form->getValue('username');
                $password = $form->getValue('password');

                $authAdapter->setIdentity($username)
                        ->setCredential($password)
                        ->setCredentialTreatment('MD5(?)');

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();

                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);

                    $server = new Zend_View_Helper_ServerUrl();
                    $server->setScheme('http');
                    $this->_redirect($server->serverUrl($this->view->url(
                        array('controller' => 'zdjecia',
                              'action' => 'index'
                        )
                    )));
//                    $this->_redirect('/zdjecia/');
                } else {
                    $this->view->errorMessage = 'Nieprawidłowa nazwa użytkownika lub hasło.';
                }
            }
        }
        $this->view->form = $form;
    }

    public function wylogowanieAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $server = new Zend_View_Helper_ServerUrl();
        $server->setScheme('http');
        $this->_redirect($server->serverUrl($this->view->url(
            array('controller' => 'index',
                  'action' => 'index'
            )
        )));
//        $this->_redirect('/');
    }

}