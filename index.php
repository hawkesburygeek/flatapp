<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * Site Location
 *
 * The site location will be used for including other
 * files dynamically.
 *
 */
$site_location = realpath(dirname(__FILE__));
define('__SITE_LOCATION', $site_location);

/**
 * Content Location
 *
 * The location of the 'content' folder.
 *
 */
$content_location = $site_location.DIRECTORY_SEPARATOR.'content'.DIRECTORY_SEPARATOR;
define('__CONTENT_LOCATION', $content_location);

/**
 * Config Location
 *
 * The location of the 'config' folder.
 *
 */
$config_location = $site_location.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
define('__CONFIG_LOCATION', $config_location);

/**
 * Plugin Location
 *
 * The location of the 'plugins' folder.
 *
 */
$plugin_location = $site_location.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR;
define('__PLUGIN_LOCATION', $plugin_location);

/**
 * Framework Location
 *
 * The location of the 'framework' folder.
 *
 */
$framework_location = $site_location.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'framework'.DIRECTORY_SEPARATOR;
define('__FRAMEWORK_LOCATION', $framework_location);


include __FRAMEWORK_LOCATION.'start.php';
