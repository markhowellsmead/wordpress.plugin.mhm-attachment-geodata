<?php

namespace MHM\AttachmentGeodata;

class Plugin
{

    public $key = '';
    public $version = '1.0';

    public function __construct()
    {
        $this->key = basename(__DIR__);
        add_filter('wp_read_image_metadata', array($this, 'add_geo_exif'), 10, 2);
    }

    public function add_geo_exif($meta, $file)
    {
        $exif = @exif_read_data($file);
        if ($exif && isset($exif['GPSLatitude']) && isset($exif['GPSLongitude'])) {
            $meta['latitude'] = $exif['GPSLatitude'];
            $meta['latitude_ref'] = trim($exif['GPSLatitudeRef']);
            $meta['longitude'] = $exif['GPSLongitude'];
            $meta['longitude_ref'] = trim($exif['GPSLongitudeRef']);
        }
        return $meta;
    }

}

new Plugin();
