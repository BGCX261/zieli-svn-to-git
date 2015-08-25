<?php

class Model_Photo extends Model_DomainObjectAbstract
{
    protected $_catalogs_id = null;
    protected $_filename = null;
    protected $_filesize = null;
    protected $_mimeType = null;
    protected $_height = null;
    protected $_width = null;
    protected $_dateTimeOriginal = null;
    protected $_make = null;
    protected $_model = null;
    protected $_orientation = null;
    protected $_xResolution = null;
    protected $_yResolution = null;
    protected $_exposureTime = null;
    protected $_exposureProgram = null;
    protected $_exposureMode = null;
    protected $_fNumber = null;
    protected $_focalLength = null;
    protected $_isoSpeedRatings = null;
    protected $_lightSource = null;
    protected $_whiteBalance = null;
    protected $_flash = null;
    protected $_digitalZoomRatio = null;
    protected $_gpsLatitudeRef = null;
    protected $_gpsLatitude = null;
    protected $_gpsLongitudeRef = null;
    protected $_gpsLongitude = null;
    protected $_headline = null;
    protected $_caption = null;
    protected $_writer = null;
    protected $_copyrightNotice = null;
    protected $_contact = null;
    protected $_objectName = null;
    protected $_byLineTitle = null;
    protected $_city = null;
    protected $_subLocation = null;
    protected $_province = null;
    protected $_countryCode = null;
    protected $_country = null;
    protected $_keywords = null;

    public function getCatalogsId() {
        return $this->_catalogs_id;
    }

    public function setCatalogsId($catalogId) {
        $this->_catalogs_id = $catalogId;
    }

    public function getFilename() {
        return $this->_filename;
    }

    public function setFilename($filename) {
        $this->_filename = $filename;
    }

    public function getFilesize() {
        return $this->_filesize;
    }

    public function setFilesize($filesize) {
        $this->_filesize = $filesize;
    }

    public function getMimeType() {
        return $this->_mimeType;
    }

    public function setMimeType($mimeType) {
        $this->_mimeType = $mimeType;
    }

    public function getHeight() {
        return $this->_height;
    }

    public function setHeight($height) {
        $this->_height = $height;
    }

    public function getWidth() {
        return $this->_width;
    }

    public function setWidth($width) {
        $this->_width = $width;
    }

    public function getDateTimeOriginal() {
        return $this->_dateTimeOriginal;
    }

    public function setDateTimeOriginal($dateTimeOriginal) {
        $this->_dateTimeOriginal = $dateTimeOriginal;
    }

    public function getMake() {
        return $this->_make;
    }

    public function setMake($make) {
        $this->_make = $make;
    }

    public function getModel() {
        return $this->_model;
    }

    public function setModel($model) {
        $this->_model = $model;
    }

    public function getOrientation() {
        return $this->_orientation;
    }

    public function setOrientation($orientation) {
        $this->_orientation = $orientation;
    }

    public function getXResolution() {
        return $this->_xResolution;
    }

    public function setXResolution($xResolution) {
        $this->_xResolution = $xResolution;
    }

    public function getYResolution() {
        return $this->_yResolution;
    }

    public function setYResolution($yResolution) {
        $this->_yResolution = $yResolution;
    }

    public function getExposureTime() {
        return $this->_exposureTime;
    }

    public function setExposureTime($exposureTime) {
        $this->_exposureTime = $exposureTime;
    }

    public function getExposureProgram() {
        return $this->_exposureProgram;
    }

    public function setExposureProgram($exposureProgram) {
        $this->_exposureProgram = $exposureProgram;
    }

    public function getExposureMode() {
        return $this->_exposureMode;
    }

    public function setExposureMode($exposureMode) {
        $this->_exposureMode = $exposureMode;
    }

    public function getFNumber() {
        return $this->_fNumber;
    }

    public function setFNumber($fNumber) {
        $this->_fNumber = $fNumber;
    }

    public function getFocalLength() {
        return $this->_focalLength;
    }

    public function setFocalLength($focalLength) {
        $this->_focalLength = $focalLength;
    }

    public function getIsoSpeedRatings() {
        return $this->_isoSpeedRatings;
    }

    public function setIsoSpeedRatings($isoSpeedRatings) {
        $this->_isoSpeedRatings = $isoSpeedRatings;
    }

    public function getLightSource() {
        return $this->_lightSource;
    }

    public function setLightSource($lightSource) {
        $this->_lightSource = $lightSource;
    }

    public function getWhiteBalance() {
        return $this->_whiteBalance;
    }

    public function setWhiteBalance($whiteBalance) {
        $this->_whiteBalance = $whiteBalance;
    }

    public function getFlash() {
        return $this->_flash;
    }

    public function setFlash($flash) {
        $this->_flash = $flash;
    }

    public function getDigitalZoomRatio() {
        return $this->_digitalZoomRatio;
    }

    public function setDigitalZoomRatio($digitalZoomRatio) {
        $this->_digitalZoomRatio = $digitalZoomRatio;
    }

    public function getGpsLatitudeRef() {
        return $this->_gpsLatitudeRef;
    }

    public function setGpsLatitudeRef($gpsLatitudeRef) {
        $this->_gpsLatitudeRef = $gpsLatitudeRef;
    }

    public function getGpsLatitude() {
        return $this->_gpsLatitude;
    }

    public function setGpsLatitude($gpsLatitude) {
        $this->_gpsLatitude = $gpsLatitude;
    }

    public function getGpsLongitudeRef() {
        return $this->_gpsLongitudeRef;
    }

    public function setGpsLongitudeRef($gpsLongitudeRef) {
        $this->_gpsLongitudeRef = $gpsLongitudeRef;
    }

    public function getGpsLongitude() {
        return $this->_gpsLongitude;
    }

    public function setGpsLongitude($gpsLongitude) {
        $this->_gpsLongitude = $gpsLongitude;
    }

    public function getHeadline() {
        return $this->_headline;
    }

    public function setHeadline($headline) {
        $this->_headline = $headline;
    }

    public function getCaption() {
        return $this->_caption;
    }

    public function setCaption($caption) {
        $this->_caption = $caption;
    }

    public function getWriter() {
        return $this->_writer;
    }

    public function setWriter($writer) {
        $this->_writer = $writer;
    }

    public function getCopyrightNotice() {
        return $this->_copyrightNotice;
    }

    public function setCopyrightNotice($copyrightNotice) {
        $this->_copyrightNotice = $copyrightNotice;
    }

    public function getContact() {
        return $this->_contact;
    }

    public function setContact($contact) {
        $this->_contact = $contact;
    }

    public function getObjectName() {
        return $this->_objectName;
    }

    public function setObjectName($objectName) {
        $this->_objectName = $objectName;
    }

    public function getByLineTitle() {
        return $this->_byLineTitle;
    }

    public function setByLineTitle($byLineTitle) {
        $this->_byLineTitle = $byLineTitle;
    }

    public function getCity() {
        return $this->_city;
    }

    public function setCity($city) {
        $this->_city = $city;
    }

    public function getSubLocation() {
        return $this->_subLocation;
    }

    public function setSubLocation($subLocation) {
        $this->_subLocation = $subLocation;
    }

    public function getProvince() {
        return $this->_province;
    }

    public function setProvince($province) {
        $this->_province = $province;
    }

    public function getCountryCode() {
        return $this->_countryCode;
    }

    public function setCountryCode($countryCode) {
        $this->_countryCode = $countryCode;
    }

    public function getCountry() {
        return $this->_country;
    }

    public function setCountry($country) {
        $this->_country = $country;
    }

    public function getKeywords() {
        return $this->_keywords;
    }

    public function setKeywords($keywords) {
        $this->_keywords = $keywords;
    }

    /**
     * Pobranie metadanych ze zdjęcia
     *
     */
    public function pobierzMetadane($file, $filename, $catalogId) {
        $this->setCatalogsId($catalogId);
        $this->setFilename($filename);

        //Odczyt danych IPTC z pliku
        $iptc = new Model_Iptc();
        $iptc->iptc($file);

        $this->setHeadline($iptc->get(IPTC_HEADLINE));
        $this->setCaption($iptc->get(IPTC_CAPTION));
        $this->setWriter($iptc->get(IPTC_WRITER));
        $this->setCopyrightNotice($iptc->get(IPTC_COPYRIGHT_NOTICE));
        $this->setContact($iptc->get(IPTC_CONTACT));
        $this->setObjectName($iptc->get(IPTC_OBJECT_NAME));
        $this->setByLineTitle($iptc->get(IPTC_BYLINE_TITLE));
        $this->setCity($iptc->get(IPTC_CITY));
        $this->setSubLocation($iptc->get(IPTC_SUB_LOCATION));
        $this->setProvince($iptc->get(IPTC_PROVINCE_STATE));
        $this->setCountryCode($iptc->get(IPTC_COUNTRY_CODE));
        $this->setCountry($iptc->get(IPTC_COUNTRY));
        $this->setKeywords($iptc->get(IPTC_KEYWORDS));

        //Odczyt danych EXIF z pliku za pomocą exif_reader()
        $modelExif = new Model_Exif();
        $modelExif->exif($file);

        $this->setFilesize($modelExif->get('FILE', 'FileSize'));
        $this->setMimeType($modelExif->get('FILE', 'MimeType'));
        $this->setHeight($modelExif->get('COMPUTED', 'Height'));
        $this->setWidth($modelExif->get('COMPUTED', 'Width'));

        //Odczyt danych EXIF z pliku za pomocą PEL (PHP Exif Library)
//        include_once('C:\xampp\php\PEAR\PelJpeg.php');
        require_once 'pel-0.9.1/PelJpeg.php';

        $jpeg = new PelJpeg($file);

        $data = $jpeg->getExif();

        if($data) {
            $ifd0 = $data->getTiff()->getIfd();
            $exif = $ifd0->getSubIfd(PelIfd::EXIF);
            $gps = $ifd0->getSubIfd(PelIfd::GPS);

            //ifd0
            if($ifd0) {
                if($tag = $ifd0->getEntry(PelTag::MAKE)){
                    $this->setMake($tag->getText());
                }
                if($tag = $ifd0->getEntry(PelTag::MODEL)){
                    $this->setModel($tag->getText());
                }
                if($tag = $ifd0->getEntry(PelTag::ORIENTATION)){
                    $this->setOrientation($tag->getText());
                }
                if($tag = $ifd0->getEntry(PelTag::X_RESOLUTION)){
                    $this->setXResolution($tag->getText());
                }
                if($tag = $ifd0->getEntry(PelTag::Y_RESOLUTION)){
                    $this->setYResolution($tag->getText());
                }
            }
            
            //exif
            if($exif) {
                if($tag = $exif->getEntry(PelTag::DATE_TIME_ORIGINAL)){
                    $this->setDateTimeOriginal($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::EXPOSURE_TIME)){
                    $this->setExposureTime($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::EXPOSURE_PROGRAM)){
                    $this->setExposureProgram($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::EXPOSURE_MODE)){
                    $this->setExposureMode($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::FNUMBER)){
                    $this->setFNumber($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::FOCAL_LENGTH)){
                    $this->setFocalLength($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::ISO_SPEED_RATINGS)){
                    $this->setIsoSpeedRatings($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::LIGHT_SOURCE)){
                    $this->setLightSource($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::FLASH)){
                    $this->setFlash($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::WHITE_BALANCE)){
                    $this->setWhiteBalance($tag->getText());
                }
                if($tag = $exif->getEntry(PelTag::DIGITAL_ZOOM_RATIO)){
                    $this->setDigitalZoomRatio($tag->getText());
                }
            }
            //gps
            if($gps){
                $this->setGpsLatitudeRef($gps->getEntry(PelTag::GPS_LATITUDE_REF)->getText());
                $this->setGpsLatitude(substr($gps->getEntry(PelTag::GPS_LATITUDE)->getText(), -7, 5));
                $this->setGpsLongitudeRef($gps->getEntry(PelTag::GPS_LONGITUDE_REF)->getText());
                $this->setGpsLongitude(substr($gps->getEntry(PelTag::GPS_LONGITUDE)->getText(), -7, 5));
            }
        }
    }
}