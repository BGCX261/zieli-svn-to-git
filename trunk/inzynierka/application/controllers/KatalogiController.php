<?php
/**
 * Zarządzanie katalogoami:
 * tworzenie, edycja, usuwanie
 *
 */
class KatalogiController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->dodajAction();
        
        $user_id = Zend_Auth::getInstance()->getIdentity()->id;

        $katalogi = Model_CatalogMapper::getInstance();
        $lista = $katalogi->listaKatalogow($user_id);
        $this->view->lista = $lista;
    }

    public function dodajAction()
    {
        $form = new Form_Catalog();
        $this->view->form = $form;

        $user_id = Zend_Auth::getInstance()->getIdentity()->id;
        $user_name = Zend_Auth::getInstance()->getIdentity()->username;

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $dane = $form->getValues();
                $katalog = $dane['catalog'];

                $sciezka = 'userdata/' . $user_name . '/photos/' . $katalog;

                $obj = new Model_Catalog();
                $obj->setName($katalog);
                $obj->setPath($sciezka);
                $obj->setUsersId($user_id);

                $mapper = Model_CatalogMapper::getInstance();
                $wynik = $mapper->sprawdzNazwe($user_id, $katalog);
                if (!$wynik) {
                    $mapper->save($obj);
                    //$dir_name = iconv('UTF-8','cp1250', $sciezka);
                    $dir_name = $sciezka;
                    mkdir($dir_name);
                    $this->view->message = 'Dodano pomyślnie.';
                } else {
                    $this->view->message = 'Katalog o podanej nazwie już istnieje.';
                }
            } else {
                $this->view->message = 'Nieprawidłowa nazwa katalogu.';
            }
        }
    }

    public function edytujAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()) {
            $id_katalogu = $this->getRequest()->getParam('id');
            $nowa_nazwa = $this->getRequest()->getParam('value');
            $user_name = Zend_Auth::getInstance()->getIdentity()->username;

            $mapper = Model_CatalogMapper::getInstance();
            $katalog = $mapper->katalog($id_katalogu);

            $aktualna_nazwa = $katalog->getName();
            $aktualny_katalog = $katalog->getPath();

            if($nowa_nazwa != $aktualna_nazwa) {
                $nowy_katalog = 'userdata/' . $user_name . '/photos/' . $nowa_nazwa;
                rename($aktualny_katalog, $nowy_katalog);

                $katalog->setName($nowa_nazwa);
                $katalog->setPath($nowy_katalog);

                $mapper->save($katalog);
            } else {
                echo "<script>alert('Nie można zmieniać na tą samą nazwę!');</script>";
            }
            
        }
        $this->view->nowanazwa = $nowa_nazwa;
    }

    public function usunAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()) {
            $id_katalogu = $this->getRequest()->getParam('id');

            $mapper = Model_CatalogMapper::getInstance();
            $katalog = $mapper->katalog($id_katalogu);
            $dir = $katalog->getPath();

            //usuwanie katalogu wraz z jego zawartością
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") {
                        rrmdir($dir."/".$object);
                    } else {
                        unlink($dir."/".$object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);

            $mapper->delete($id_katalogu);
        }
    }

}