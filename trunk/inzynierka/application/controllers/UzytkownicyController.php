<?php

class UzytkownicyController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function rejestracjaAction()
    {
        $form = new Form_Register();
        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $data = $form->getValues();

                $model = new Model_User();

                $model->setFirstname($data['firstname']);
                $model->setLastname($data['lastname']);
                $model->setUsername($data['username']);
                $model->setPassword(md5($data['password']));
                $model->setEmail($data['email']);

                $mapper = Model_UserMapper::getInstance();
                $mapper->save($model);

                $this->createConfig($data['username']);

                $server = new Zend_View_Helper_ServerUrl();
                $server->setScheme('http');
                $this->_redirect($server->serverUrl($this->view->url(
                    array('controller' => 'autentykacja',
                          'action' => 'logowanie'
                    )
                )));
//                $this->_redirect('/autentykacja/logowanie');
            } else {
                $this->view->errorMessage = 'Nie uzupełniono wymaganych pól.';
            }
        }
        $this->view->form = $form;
    }

    private function createConfig($user)
    {
        $home_dir = 'userdata/' . $user;
        $photos_dir = $home_dir . '/photos';
        mkdir($home_dir);
        mkdir($photos_dir);
    }

    public function daneAction()
    {
        $idUzytkownika = $this->getRequest()->getParam('id');

        $model = new Model_UserMapper();
        $dane = $model->daneUzytkownika($idUzytkownika);
    }


}





