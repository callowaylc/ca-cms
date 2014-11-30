<?php

// require application bootstrap
require_once './bootstrap.php';

/* Default value for some constants if they have not yet been set
   by the host-specific config files */
if (!defined('ABSPATH'))
    define('ABSPATH', '/var/www/cms');
if (!defined('WP_CORE_UPDATE'))
    define('WP_CORE_UPDATE', false);
if (!defined('WP_ALLOW_MULTISITE'))
    define('WP_ALLOW_MULTISITE', false);
if (!defined('WP_CONTENT_DIR') && !defined('DONT_SET_WP_CONTENT_DIR'))
    define('WP_CONTENT_DIR', '/var/www/cms/wp-content');

define('FS_METHOD', 'direct');
/* Default value for the table_prefix variable so that it doesn't need to
   be put in every host-specific config file */
if (!isset($table_prefix)) {
    $table_prefix = 'wp_';
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS'] = 'on';

require_once(ABSPATH . 'wp-settings.php');
?>
