<?php

class Form_Catalog extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
//        $this->setAction(Zend_Controller_Front::getInstance()
//                            ->getBaseUrl() . '/katalogi/dodaj');

        $this->addElement('text', 'catalog', array(
            'label'    => 'Nazwa katalogu',
            'required' => true,
        ));

        $this->addElement('submit', 'add', array(
            'label' => 'Dodaj',
        ));
    }

}