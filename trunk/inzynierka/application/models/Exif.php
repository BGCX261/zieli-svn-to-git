<?php

class Model_Exif
{
    protected $_metadata = null;

    public function exif($filename)
    {
        $this->_metadata = exif_read_data($filename, 0, true);
    }

    public function set($section, $tag, $data)
    {
        $this->_metadata[$section][$tag] = $data;
    }

    public function get($section, $tag)
    {
        return $this->_metadata[$section][$tag];
    }

    public function dump()
    {
        print_r($this->_metadata);
    }

}