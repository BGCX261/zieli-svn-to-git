<?php
/**
 * Zarządzanie metadanymi:
 * wyświetlanie, edycja, usuwanie
 */
class MetadaneController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->layout()->disableLayout();
        $idZdjecia = $this->getRequest()->getParam('id');

        $mapper = Model_PhotoMapper::getInstance();
        $metadane = $mapper->Metadane($idZdjecia);

        $this->view->metadane = $metadane;
    }

    public function edytujAction()
    {
        $this->_helper->layout()->disableLayout();
        if ($this->getRequest()->isPost()) {
            $pole = $this->getRequest()->getParam('pole');
            $wartosc = $this->getRequest()->getParam('value');
            $id_zdjec_string = $this->getRequest()->getParam('id');
            $id_zdjec = array_filter(explode(' ', $id_zdjec_string));

            foreach ($id_zdjec as $id_zdjecia) {
                //pobranie aktualnych metadanych z bazy
                $photoMapper = Model_PhotoMapper::getInstance();
                $metadane = $photoMapper->Metadane($id_zdjecia);
                $id_katalogu = $metadane->getCatalogsId();

                //pobranie ścieżki do zdjęcia
                $catalogMapper = Model_CatalogMapper::getInstance();
                $katalog = $catalogMapper->katalog($id_katalogu);
                $file = $katalog->getPath() . '/' . $metadane->getFilename();

                //edycja metadanych w zdjęciu
                $iptc = new Model_Iptc();
                $iptc->iptc($file);

                //ustawienie nowych wartości i zapis metadanych do zdjęcia
                switch($pole) {
                    case 'filename' :
                        $metadane->setFilename($wartosc);
                        $file_new = $katalog->getPath(). '/' . $wartosc;
                        rename($file, $file_new);
                        break;
                    case 'headline' :
                        $metadane->setHeadline($wartosc);
                        $iptc->set(IPTC_HEADLINE, $wartosc);
                        $iptc->write();
                        break;
                    case 'caption' :
                        $metadane->setCaption($wartosc);
                        $iptc->set(IPTC_CAPTION, $wartosc);
                        $iptc->write();
                        break;
                    case 'writer' :
                        $metadane->setWriter($wartosc);
                        $iptc->set(IPTC_WRITER, $wartosc);
                        $iptc->write();
                        break;
                    case 'copyrigthNotice' :
                        $metadane->setCopyrightNotice($wartosc);
                        $iptc->set(IPTC_COPYRIGHT_NOTICE, $wartosc);
                        $iptc->write();
                        break;
                    case 'contact' :
                        $metadane->setContact($wartosc);
                        $iptc->set(IPTC_CONTACT, $wartosc);
                        $iptc->write();
                        break;
                    case 'objectName' :
                        $metadane->setObjectName($wartosc);
                        $iptc->set(IPTC_OBJECT_NAME, $wartosc);
                        $iptc->write();
                        break;
                    case 'byLineTitle' :
                        $metadane->setByLineTitle($wartosc);
                        $iptc->set(IPTC_BYLINE_TITLE, $wartosc);
                        $iptc->write();
                        break;
                    case 'city' :
                        $metadane->setCity($wartosc);
                        $iptc->set(IPTC_CITY, $wartosc);
                        $iptc->write();
                        break;
                    case 'subLocation' :
                        $metadane->setSubLocation($wartosc);
                        $iptc->set(IPTC_SUB_LOCATION, $wartosc);
                        $iptc->write();
                        break;
                    case 'province' :
                        $metadane->setProvince($wartosc);
                        $iptc->set(IPTC_PROVINCE_STATE, $wartosc);
                        $iptc->write();
                        break;
                    case 'countryCode' :
                        $metadane->setCountryCode($wartosc);
                        $iptc->set(IPTC_COUNTRY_CODE, $wartosc);
                        $iptc->write();
                        break;
                    case 'country' :
                        $metadane->setCountry($wartosc);
                        $iptc->set(IPTC_COUNTRY, $wartosc);
                        $iptc->write();
                        break;
                    case 'keywords' :
                        $dopisz = strcmp('*', $wartosc[0]);
                        if ($dopisz == 0) {
                            $slowa_kluczowe = substr($wartosc, 1);
                            $poprzednio = $metadane->getKeywords();
                            $metadane->setKeywords($poprzednio . ' ' . $slowa_kluczowe);
                            $iptc->set(IPTC_KEYWORDS, $poprzednio . ' ' .  $slowa_kluczowe);
                        } else {
                            $metadane->setKeywords($wartosc);
                            $iptc->set(IPTC_KEYWORDS, $wartosc);
                        }
                        $iptc->write();
                        break;
                    default : break;
                }
                //zapis do bazy
                $photoMapper->save($metadane);
            }
            $this->view->wartosc = $wartosc;
        }
    }

    public function wyczyscAction()
    {
        // action body
    }

    public function grupaAction()
    {
        $this->_helper->layout()->disableLayout();
        if($this->getRequest()->isPost()) {
            $id = $this->getRequest()->getParam('id');
            $liczba_opisywanych = sizeof(array_filter(explode(' ', $id)));

            $this->view->id_zdjec = $id;
            $this->view->liczba_opisywanych = $liczba_opisywanych;
        }
    }
}