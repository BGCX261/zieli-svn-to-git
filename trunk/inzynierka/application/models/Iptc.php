<?php

DEFINE('IPTC_HEADLINE', '105');
DEFINE('IPTC_CAPTION', '120');
DEFINE('IPTC_WRITER', '122');
DEFINE('IPTC_COPYRIGHT_NOTICE', '116');
DEFINE('IPTC_CONTACT', '118');
DEFINE('IPTC_OBJECT_NAME', '005');
DEFINE('IPTC_BYLINE_TITLE', '085');
DEFINE('IPTC_CITY', '090');
DEFINE('IPTC_SUB_LOCATION', '092');
DEFINE('IPTC_PROVINCE_STATE', '095');
DEFINE('IPTC_COUNTRY_CODE', '100');
DEFINE('IPTC_COUNTRY', '101');
DEFINE('IPTC_KEYWORDS', '025');

DEFINE('IPTC_EDIT_STATUS', '007');
DEFINE('IPTC_PRIORITY', '010');
DEFINE('IPTC_CATEGORY', '015');
DEFINE('IPTC_SUPPLEMENTAL_CATEGORY', '020');
DEFINE('IPTC_FIXTURE_IDENTIFIER', '022');
DEFINE('IPTC_RELASE_DATE', '030');
DEFINE('IPTC_RELASE_TIME', '035');
DEFINE('IPTC_SPECIAL_INSTRUCTIONS', '040');
DEFINE('IPTC_REFERENCE_SERVICE', '045');
DEFINE('IPTC_REFERENCE_DATE', '047');
DEFINE('IPTC_REFERENCE_NUMBER', '050');
DEFINE('IPTC_CREATED_DATE', '055');
DEFINE('IPTC_CREATED_TIME', '060');
DEFINE('IPTC_ORIGINATING_PROGRAM', '065');
DEFINE('IPTC_PROGRAM_VERSION', '070');
DEFINE('IPTC_OBJECT_CYCLE', '075');
DEFINE('IPTC_BYLINE', '080');
DEFINE('IPTC_ORIGINAL_TRANSMISSION_REFERENCE', '103');
DEFINE('IPTC_CREDIT', '110');
DEFINE('IPTC_SOURCE', '115');
DEFINE('IPTC_LOCAL_CAPTION', '121');

class Model_Iptc
{
    protected $_metadata = null;
    protected $_file = null;

    public function iptc($filename)
    {
        $size = getimagesize($filename, $info);
        if (isset($info["APP13"])) {
            $this->_metadata = iptcparse($info["APP13"]);
        }
        $this->_file = $filename;
    }

    public function set($tag, $data)
    {
        if($tag == IPTC_KEYWORDS){
            $keywords = explode(" ", $data);
            $this->_metadata["2#$tag"] = $keywords;
        } else {
            $this->_metadata["2#$tag"] = array($data);
        }
    }

    public function get($tag)
    {
        if(($tag == IPTC_KEYWORDS) && !is_null($this->_metadata["2#$tag"])){
            foreach ($this->_metadata["2#$tag"] as $value) {
                $keywords .= $value . ' ';
            }
            return $keywords;
        } else {
            return isset($this->_metadata["2#$tag"]) ? $this->_metadata["2#$tag"][0] : false;
        }
    }

    public function dump()
    {
        print_r($this->_metadata);
    }

    public function binary()
    {
        $iptc_new = '';
        foreach (array_keys($this->_metadata) as $t) {
            $tag = str_replace("2#", "", $t);
            if($tag == IPTC_KEYWORDS) {
                foreach (array_keys($this->_metadata[$t]) as $i) {
                    $iptc_new .= $this->iptc_maketag(2, $tag, $this->_metadata[$t][$i]);
                }
            } else {
                $iptc_new .= $this->iptc_maketag(2, $tag, $this->_metadata[$t][0]);
            }
        }
        return $iptc_new;
    }

    // iptc_make_tag() function by Thies C. Arntzen
    public function iptc_maketag($rec, $dat, $val)
    {
        $len = strlen($val);
        if ($len < 0x8000) {
            return chr(0x1c) . chr($rec) . chr($dat) .
            chr($len >> 8) .
            chr($len & 0xff) .
            $val;
        } else {
            return chr(0x1c) . chr($rec) . chr($dat) .
            chr(0x80) . chr(0x04) .
            chr(($len >> 24) & 0xff) .
            chr(($len >> 16) & 0xff) .
            chr(($len >> 8 ) & 0xff) .
            chr(($len ) & 0xff) .
            $val;
        }
    }

    public function write()
    {
        $mode = 0;
        $content = iptcembed($this->binary(), $this->_file, $mode);
        $filename = $this->_file;

        @unlink($filename); #delete if exists

        $fp = fopen($filename, "w");
        fwrite($fp, $content);
        fclose($fp);
    }

    /**
     * Remove tags IPTC and EXIF
     * requires GD library installed
     */
    public function removeAllTags()
    {
        $this->_metadata = Array();
        $img = imagecreatefromstring(implode(file($this->_file)));
        @unlink($this->_file); #delete if exists
        imagejpeg($img, $this->_file, 100);
    }   

}