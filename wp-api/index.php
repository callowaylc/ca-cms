<?php
/**
 * Front controller for simple api for wordpress
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once('./wp-load.php');

// require "resource" 
// @TODO obviously need some error checking here
require $_REQUEST['resource'] . '/index.php';
