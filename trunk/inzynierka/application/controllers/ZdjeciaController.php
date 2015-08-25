<?php

/**
 * Klasa do operacji na plikach:
 * - wysyłanie zdjęć na serwer,
 * - odzczyt metadanych z pliku oraz zapis do bazy danych
 * 
 */
class ZdjeciaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    /**
     * Główna część aplikacji
     */
    public function indexAction()
    {
        $userId = Zend_Auth::getInstance()->getIdentity()->id;

        $catalogMapper = Model_CatalogMapper::getInstance();
        $photoMapper = Model_PhotoMapper::getInstance();

        $katalogi = $catalogMapper->listaKatalogow($userId);
        $this->view->lista = $katalogi;

        foreach ($katalogi as $katalog) {
            $katalog_id = $katalog->getId();

            $zdjecia = $photoMapper->listaZdjec($katalog_id);
            $katalogi_lz[] = count($zdjecia);
            $suma_zdjec += count($zdjecia);
            foreach ($zdjecia as $zdjecie) {
                $rozmiar_zdjec += $zdjecie->getFilesize();
            }
        }
        $this->view->liczba_zdjec = $katalogi_lz;
        $this->view->suma_zdjec = $suma_zdjec;
        $this->view->rozmiar_zdjec = round($rozmiar_zdjec / 1024 / 1024, 2);
    }

    /**
     * Wysyłanie plików na serwer,
     * Zapis do bazy metadanych
     * 
     */
    public function katalogowanieAction()
    {
        $id_katalogu = $this->getRequest()->getParam('katalog');
        $catalogMapper = Model_CatalogMapper::getInstance();
        $katalog = $catalogMapper->katalog($id_katalogu);
        $sciezka = $katalog->getPath();

        $this->view->sciezka = $sciezka;

        if (!empty($_FILES)) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';

            //nazwy plików: tymczasowego i oryginalnego
            $file = $_FILES['Filedata']['tmp_name'];
            $filename = $_FILES['Filedata']['name'];

            //sprawdzenie czy istnieje taka nazwa w bazie
            $photoMapper = Model_PhotoMapper::getInstance();
            $filename_tmp = $filename;
            $i = 1;
            do {
                $nazwa_spr = $photoMapper->sprawdzNazwe($id_katalogu, $filename_tmp);
                if ($nazwa_spr) {
                    if ($i == 1) {
                        $filename = substr($filename_tmp, 0, -4);
                    } else if ($i < 10) {
                        $filename = substr($filename_tmp, 0, -8);
                    } else {
                        $filename = substr($filename_tmp, 0, -9);
                    }
                    $filename_tmp = $filename . ' (' . $i . ')' . '.jpg';
                    $i++;
                    $a = true;
                } else {
                    $a = false;
                }
            } while ($a);
            $targetFile = str_replace('//', '/', $targetPath) . $filename_tmp;

            //pobranie metadanych ze zdjęcia i zapis do bazy
            $zdjecie = new Model_Photo();
            $zdjecie->pobierzMetadane($file, $filename_tmp, $id_katalogu);
            $mapper = Model_PhotoMapper::getInstance();
            $mapper->save($zdjecie);

            //przesłanie zdjęcia na serwer
            move_uploaded_file($tempFile, $targetFile);
            echo str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetFile);

            //generowanie miniatury do exifa (jeśli nie ma)
            $miniatura = new Model_Thumbnail();
            $miniatura->generujMiniature($targetFile);
        }
    }

    /**
     * Wyświetlanie zdjęć wybranego katalogu
     * 
     */
    public function pokazZdjeciaAction()
    {
        $this->_helper->layout()->disableLayout();
        $id = $this->getRequest()->getParam('id');
        $this->view->id = $id;

        //lista zdjęć
        //znalezie id albumu na podstawie nazwy pobranej z parametru url
        $id_katalogu = $this->getRequest()->getParam('id');
        if ($id_katalogu) {
            $katalogi = Model_CatalogMapper::getInstance();
            $katalog = $katalogi->katalog($id_katalogu);

            $zdjecia = Model_PhotoMapper::getInstance();
            $listaZdjec = $zdjecia->listaZdjec($id_katalogu);

            $this->view->katalog = $katalog;
            $this->view->listaZdjec = $listaZdjec;
        } else {
            $this->view->errorMessage = 'Nie wybrano katalogu.';
        }
    }

    public function usunAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()) {
            $id = $this->getRequest()->getParam('id');
            $id_zdjec = array_filter(explode(' ', $id));

            foreach ($id_zdjec as $id_zdjecia) {
                $photoMapper = Model_PhotoMapper::getInstance();
                $zdjecie = $photoMapper->Metadane($id_zdjecia);
                $nazwa_pliku = $zdjecie->getFilename();
                $id_katalogu = $zdjecie->getCatalogsId();

                $catalogMapper = Model_CatalogMapper::getInstance();
                $katalog = $catalogMapper->katalog($id_katalogu);
                $sciezka = $katalog->getPath();

                $filename = $sciezka . '/' . $nazwa_pliku;

                unlink($filename);

                $photoMapper->delete($id_zdjecia);
            }
        }
    }

    public function wyszukajAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()) {
            $fraza = $this->getRequest()->getParam('fraza');

            $this->view->fraza = $fraza;

            $id_uzytkownika = Zend_Auth::getInstance()->getIdentity()->id;

            //wszystkie katalogi
            $catalogMapper = Model_CatalogMapper::getInstance();
            $katalogi = $catalogMapper->listaKatalogow($id_uzytkownika);

            $photoMapper = Model_PhotoMapper::getInstance();
            foreach ($katalogi as $katalog) {
                $katalogi_sciezka[] = $katalog->getPath();
                $katalogi_zdjec[] = $photoMapper->wyszukaj($katalog->getId(), $fraza);
            }
            $this->view->katalogi_zdjec = $katalogi_zdjec;
            $this->view->katalogi_sciezka = $katalogi_sciezka;
        }
    }

    public function pobierzAction()
    {
        $id = $this->getRequest()->getParam('zdjecie');
        $photoMapper = Model_PhotoMapper::getInstance();
        $zdjecie = $photoMapper->Metadane($id)->getFilename();
        $id_katalogu = $photoMapper->Metadane($id)->getCatalogsId();

        $catalogMapper = Model_CatalogMapper::getInstance();
        $katalog = $catalogMapper->katalog($id_katalogu)->getPath();

        $sciezka = $katalog . '/' . $zdjecie;

        header('Content-Type: image/jpeg');
        header("Content-Disposition: attachment; filename=" . $zdjecie);
        readfile($sciezka);

        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }
}
