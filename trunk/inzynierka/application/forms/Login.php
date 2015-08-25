<?php

class Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()
                            ->getBaseUrl() . '/autentykacja/logowanie');

        $this->addElement('text', 'username', array(
            'label'    => 'Użytkownik',
            'required' => true,
        ));

        $this->addElement('password', 'password', array(
            'label'    => 'Hasło',
            'required' => true,
        ));

        $this->addElement('submit', 'login', array(
            'label' => 'Zaloguj',
        ));
    }

}