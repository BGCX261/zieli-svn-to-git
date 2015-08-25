<?php

class Model_PhotoMapper extends Model_DataMapperAbstract
{
    private static $_instance = null;

    public function sprawdzNazwe($id_katalogu, $nazwa_zdjecia)
    {
        $db = $this->getDb();
        $select = $db->select()->from('photos')
                               ->where('catalogs_id = ?', $id_katalogu)
                               ->where('filename = ?', $nazwa_zdjecia);

        $data = $db->fetchRow($select);
        return $data;
    }

    public function wyszukaj($id_katalogu, $fraza)
    {
        $keywords = explode(' ', $fraza);

        $db = $this->getDb();
        $select = $db->select()->from('photos');
        
        $and = '&';
        $or = '+';
        
        foreach ($keywords as $keyword) {
            if (($keyword == $and) || ($keyword == $or)) {
                $operacja = $keyword;
            } else {
                if ($keyword[0] == '!') {
                    $keyword = str_replace('!', '', $keyword);
                    if($operacja == $and) {
                        $select->where("catalogs_id = $id_katalogu AND keywords not like '%$keyword%'");
                    } else {
                        $select->orWhere("catalogs_id = $id_katalogu AND keywords not like '%$keyword%'");
                    }
                } else {
                    if($operacja == $and) {
                        $select->where("catalogs_id = $id_katalogu AND keywords like '%$keyword%'");
                    } else {
                        $select->orWhere("catalogs_id = $id_katalogu AND keywords like '%$keyword%'");
                    }
                }
            }
        }

        $data = $db->fetchAll($select);
        $tab = array();
        foreach ($data as $da){
            $tab[] = $this->_populate($da);
        }

        if(is_null($data)) {
            return false;
        } else {
            return $tab;
        }
    }

    public function Metadane($id)
    {
        $db = $this->getDb();
        $select = $db->select()->from('photos')
                               ->where('id = ?', $id);

        $data = $db->fetchRow($select);
        return $this->_populate($data);
    }

    public function listaZdjec($id_katalogu)
    {
        $db = $this->getDb();
        $select = $db->select()
                     ->from('photos')
                     ->where('catalogs_id = ?', $id_katalogu);

        $data = $db->fetchAll($select);
        $tab = array();
        foreach ($data as $da){
            $tab[] = $this->_populate($da);
        }
        return $tab;
    }

    protected function _insert(Model_DomainObjectAbstract $obj) {
        $db = $this->getDb();
        $data = array(
            'catalogs_id'       => $obj->getCatalogsId(),
            'filename'          => $obj->getFilename(),
            'filesize'          => $obj->getFilesize(),
            'mimeType'          => $obj->getMimeType(),
            'height'            => $obj->getHeight(),
            'width'             => $obj->getWidth(),
            'dateTimeOriginal'  => $obj->getDateTimeOriginal(),
            'make'              => $obj->getMake(),
            'model'             => $obj->getModel(),
            'orientation'       => $obj->getOrientation(),
            'xResolution'       => $obj->getXResolution(),
            'yResolution'       => $obj->getYResolution(),
            'exposureTime'      => $obj->getExposureTime(),
            'exposureProgram'   => $obj->getExposureProgram(),
            'exposureMode'      => $obj->getExposureMode(),
            'fNumber'           => $obj->getFNumber(),
            'focalLength'       => $obj->getFocalLength(),
            'isoSpeedRatings'   => $obj->getIsoSpeedRatings(),
            'lightSource'       => $obj->getLightSource(),
            'whiteBalance'      => $obj->getWhiteBalance(),
            'flash'             => $obj->getFlash(),
            'digitalZoomRatio'  => $obj->getDigitalZoomRatio(),
            'gpsLatitudeRef'    => $obj->getGpsLatitudeRef(),
            'gpsLatitude'       => $obj->getGpsLatitude(),
            'gpsLongitudeRef'   => $obj->getGpsLongitudeRef(),
            'gpsLongitude'      => $obj->getGpsLongitude(),
            'headline'          => $obj->getHeadline(),
            'caption'           => $obj->getCaption(),
            'writer'            => $obj->getWriter(),
            'copyrightNotice'   => $obj->getCopyrightNotice(),
            'contact'           => $obj->getContact(),
            'objectName'        => $obj->getObjectName(),
            'byLineTitle'       => $obj->getByLineTitle(),
            'city'              => $obj->getCity(),
            'subLocation'       => $obj->getSubLocation(),
            'province'          => $obj->getProvince(),
            'countryCode'       => $obj->getCountryCode(),
            'country'           => $obj->getCountry(),
            'keywords'          => $obj->getKeywords()
        );

        $db->insert('photos', $data);
    }

    protected function _populate($data) {
        $obj = new Model_Photo();

        $obj->setId($data['id']);
        $obj->setCatalogsId($data['catalogs_id']);
        $obj->setFilename($data['filename']);
        $obj->setFilesize($data['filesize']);
        $obj->setMimeType($data['mimeType']);
        $obj->setHeight($data['height']);
        $obj->setWidth($data['width']);
        $obj->setDateTimeOriginal($data['dateTimeOriginal']);
        $obj->setMake($data['make']);
        $obj->setModel($data['model']);
        $obj->setOrientation($data['orientation']);
        $obj->setXResolution($data['xResolution']);
        $obj->setYResolution($data['yResolution']);
        $obj->setExposureTime($data['exposureTime']);
        $obj->setExposureProgram($data['exposureProgram']);
        $obj->setExposureMode($data['exposureMode']);
        $obj->setFNumber($data['fNumber']);
        $obj->setFocalLength($data['focalLength']);
        $obj->setIsoSpeedRatings($data['speedRatings']);
        $obj->setLightSource($data['lightSource']);
        $obj->setWhiteBalance($data['whiteBalance']);
        $obj->setFlash($data['flash']);
        $obj->setDigitalZoomRatio($data['digitalZoomRatio']);
        $obj->setGpsLatitudeRef($data['gpsLatitudeRef']);
        $obj->setGpsLatitude($data['gpsLatitude']);
        $obj->setGpsLongitudeRef($data['gpsLongitudeRef']);
        $obj->setGpsLongitude($data['gpsLongitude']);
        $obj->setHeadline($data['headline']);
        $obj->setCaption($data['caption']);
        $obj->setWriter($data['writer']);
        $obj->setCopyrightNotice($data['copyrightNotice']);
        $obj->setContact($data['contact']);
        $obj->setObjectName($data['objectName']);
        $obj->setByLineTitle($data['byLineTitle']);
        $obj->setCity($data['city']);
        $obj->setSubLocation($data['subLocation']);
        $obj->setProvince($data['province']);
        $obj->setCountryCode($data['countryCode']);
        $obj->setCountry($data['country']);
        $obj->setKeywords($data['keywords']);

        return $obj;
    }

    public function delete($id)
    {
        $db = $this->getDb();
        $where = $db->quoteInto('id = ?', $id);
        $db->delete('photos', $where);
    }

    protected function _update(Model_DomainObjectAbstract $obj) {
        $db = $this->getDb();
        $data = array(
            'catalogs_id'       => $obj->getCatalogsId(),
            'filename'          => $obj->getFilename(),
            'filesize'          => $obj->getFilesize(),
            'mimeType'          => $obj->getMimeType(),
            'height'            => $obj->getHeight(),
            'width'             => $obj->getWidth(),
            'dateTimeOriginal'  => $obj->getDateTimeOriginal(),
            'make'              => $obj->getMake(),
            'model'             => $obj->getModel(),
            'orientation'       => $obj->getOrientation(),
            'xResolution'       => $obj->getXResolution(),
            'yResolution'       => $obj->getYResolution(),
            'exposureTime'      => $obj->getExposureTime(),
            'exposureProgram'   => $obj->getExposureProgram(),
            'exposureMode'      => $obj->getExposureMode(),
            'fNumber'           => $obj->getFNumber(),
            'focalLength'       => $obj->getFocalLength(),
            'isoSpeedRatings'   => $obj->getIsoSpeedRatings(),
            'lightSource'       => $obj->getLightSource(),
            'whiteBalance'      => $obj->getWhiteBalance(),
            'flash'             => $obj->getFlash(),
            'digitalZoomRatio'  => $obj->getDigitalZoomRatio(),
            'gpsLatitudeRef'    => $obj->getGpsLatitudeRef(),
            'gpsLatitude'       => $obj->getGpsLatitude(),
            'gpsLongitudeRef'   => $obj->getGpsLongitudeRef(),
            'gpsLongitude'      => $obj->getGpsLongitude(),
            'headline'          => $obj->getHeadline(),
            'caption'           => $obj->getCaption(),
            'writer'            => $obj->getWriter(),
            'copyrightNotice'   => $obj->getCopyrightNotice(),
            'contact'           => $obj->getContact(),
            'objectName'        => $obj->getObjectName(),
            'byLineTitle'       => $obj->getByLineTitle(),
            'city'              => $obj->getCity(),
            'subLocation'       => $obj->getSubLocation(),
            'province'          => $obj->getProvince(),
            'countryCode'       => $obj->getCountryCode(),
            'country'           => $obj->getCountry(),
            'keywords'          => $obj->getKeywords()
        );
        $where = $db->quoteInto('id = ?', $obj->getId());
        $db->update('photos', $data, $where);
    }

    /**
     *
     * @return Model_PhotoMapper
     */
    public static function getInstance()
    {
            if (is_null(self::$_instance)) {
                    $c = __CLASS__;
                    self::$_instance = new $c();
            }
            return self::$_instance;
    }

}