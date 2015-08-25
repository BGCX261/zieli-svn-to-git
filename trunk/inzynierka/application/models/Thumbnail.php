<?php

class Model_Thumbnail
{
    /**
     * Generuje miniaturę i zapisuje do exifa
     * @param <type> $fullpath
     */
    public function generujMiniature($fullpath)
    {
//        include_once('C:\xampp\php\PEAR\PelJpeg.php');
//        include_once('C:\xampp\php\PEAR\PelExif.php');
//        include_once('C:\xampp\php\PEAR\PelIfd.php');

        $jpeg = new PelJpeg($fullpath);
        $exif = $jpeg->getExif();

        //Jeżeli zdjęcie nie posiada exifa
        if(!$exif) {
            //Utworzenie kontera exif
            $pelexif = new PelExif();
            //Dodanie obiektu PelTiff i PelIfd
            $tiff = new PelTiff();
            $ifd0 = new PelIfd(PelIfd::IFD0);

            $tiff->setIfd($ifd0);
            $pelexif->setTiff($tiff);
            //Dodanie obiektów do zdjęcia
            $jpeg->setExif($pelexif);
        }

        $exif = $jpeg->getExif();
        $tiff = $exif->getTiff();

        $ifd0 = $tiff->getIfd();
        $ifd1 = $ifd0->getNextIfd();

        //tworzenie miniatury jeżli nie istnieje (nie ma IFD1)
        if (!$ifd1) {
            $ifd1 = new PelIfd(1);
            //point ifd0 to the new ifd1 (or else ifd1 will not be read)
            $ifd0->setNextIfd($ifd1);

            //create image resource of original
            $original = ImageCreateFromString($jpeg->getBytes());
            $orig_w = imagesx($original);
            $orig_h = imagesy($original);
            $wmax = 160;
            $hmax = 120;

            if ($orig_w > $wmax || $orig_h > $hmax) {
                $thumb_w = $wmax;
                $thumb_h = $hmax;
                if ($thumb_w / $orig_w * $orig_h > $thumb_h)
                    $thumb_w = round($thumb_h * $orig_w / $orig_h);# maintain aspect ratio
                else
                    $thumb_h=round($thumb_w * $orig_h / $orig_w);
            }
            else { # only set the thumb's size if the original is larger than 'wmax'x'hmax'
                $thumb_w = $orig_w;
                $thumb_h = $orig_h;
            }

            # create image resource with thumbnail sizing
            $thumb = imagecreatetruecolor($thumb_w, $thumb_h);
            ## Resize original and copy to the blank thumb resource
            imagecopyresampled($thumb, $original,
                    0, 0, 0, 0, $thumb_w, $thumb_h, $orig_w, $orig_h);

            # start writing output to buffer
            ob_start();
            # outputs thumb resource contents to buffer
            ImageJpeg($thumb);
            # create PelDataWindow from buffer thumb contents (and end output to buffer)
            $window = new PelDataWindow(ob_get_clean());

            if ($window) {

                $ifd1->setThumbnail($window); # set window data as thumbnail in ifd1
                $outpath = $fullpath; # overwrite original jpg file
                file_put_contents($outpath, $jpeg->getBytes()); # write everything to output filename
            }
        }
    }

}

