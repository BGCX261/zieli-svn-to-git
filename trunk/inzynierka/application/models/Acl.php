<?php

class Model_Acl extends Zend_Acl
{
    public function __construct()
    {
        //kontrolery dodane do listy kontroli dostępu
        $this->add(new Zend_Acl_Resource('autentykacja'))
             ->add(new Zend_Acl_Resource('error'))
             ->add(new Zend_Acl_Resource('index'))
             ->add(new Zend_Acl_Resource('katalogi'))
             ->add(new Zend_Acl_Resource('metadane'))
             ->add(new Zend_Acl_Resource('uzytkownicy'))
             ->add(new Zend_Acl_Resource('zdjecia'));

        //typy użytkowników
        $this->addRole(new Zend_Acl_Role('zalogowany'))
             ->addRole(new Zend_Acl_Role('gosc'));

        //dostęp dla gościa
        $this->allow('gosc', array('index', 'autentykacja', 'uzytkownicy'));

        //dostęp dla zalogowanego
        $this->allow('zalogowany', array('index', 'zdjecia', 'metadane', 'katalogi', 'autentykacja'));
    }

}

