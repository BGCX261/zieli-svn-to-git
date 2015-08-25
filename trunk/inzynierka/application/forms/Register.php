<?php

class Form_Register extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()
                            ->getBaseUrl() . '/uzytkownicy/rejestracja');

        $this->addElement('text', 'username', array(
            'label'    => 'Login',
            'required' => true,
        ));

        $this->addElement('password', 'password', array(
            'label'    => 'Hasło',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength',
                                  'options' => array(5, 32)),
                )
        ));

        $this->addElement('text', 'firstname', array(
            'label'    => 'Imię',
            'required' => true,
        ));

        $this->addElement('text', 'lastname', array(
            'label'    => 'Nazwisko',
            'required' => true,
        ));

        $this->addElement('text', 'email', array(
            'label'      => 'Email',
            'filters'    => array('StringTrim'),
            'required'   => true,
            'validators' => array(
                'EmailAddress',
            )
        ));

        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Proszę wpisać 5 liter znajdujących się poniżej:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));

        $this->addElement('submit', 'register', array(
            'label' => 'Rejestruj',
        ));
    }

}