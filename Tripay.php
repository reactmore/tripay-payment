<?php

/**
* Check PHP version.
*/
if (version_compare(PHP_VERSION, '5.4', '<')) {
  throw new Exception('PHP version >= 5.4 required');
}

// Check PHP Curl & json decode capabilities.
if (!function_exists('curl_init') || !function_exists('curl_exec')) {
  throw new Exception('needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('needs the JSON PHP extension.');
}

// Library
require_once 'src/lib/Tripay.php';

// Action
require_once 'src/Method.php';