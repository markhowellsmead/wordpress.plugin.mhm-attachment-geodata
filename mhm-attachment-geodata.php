<?php
/*
Plugin Name: Add GEO data to attachment metadata
Plugin URI: https://github.com/markhowellsmead/wordpress.plugin.mhm-attachment-geodata
Description: Adds GEO data from an attachment file EXIF when fetching and storing its metadata.
Author: Mark Howells-Mead
Version: 1.0.0
Author URI: http://markweb.ch/
 */

if (version_compare($wp_version, '4.7', '<') || version_compare(PHP_VERSION, '5.3', '<')) {
    function mhm_attachment_geodata_compatability_warning()
    {
        echo '<div class="error"><p>' . sprintf(
            __('“%1$s” requires PHP %2$s (or newer) and WordPress %3$s (or newer) to function properly. Your site is using PHP %4$s and WordPress %5$s. Please upgrade. The plugin has been automatically deactivated.', 'TEXT-DOMAIN'),
            'Add GEO data to attachment metadata',
            '5.3',
            '4.7',
            PHP_VERSION,
            $GLOBALS['wp_version']
        ) . '</p></div>';
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
    add_action('admin_notices', 'mhm_attachment_geodata_compatability_warning');

    function mhm_attachment_geodata_deactivate_self()
    {
        deactivate_plugins(plugin_basename(__FILE__));
    }
    add_action('admin_init', 'mhm_attachment_geodata_deactivate_self');

    return;
} else {
    include 'Classes/Plugin.php';
}
