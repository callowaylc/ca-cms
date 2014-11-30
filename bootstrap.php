<?php
# author:      chrisitan calloway admin@callowayart.com
# description: loads required files for custom wordpress install

# first require composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

# set required wordpress constants
$connection = ( new callowayart\utility\Database )->parse_uri(getenv( 'DATABASE_URI' ));

# define database constants 
define( 'DB_HOST',     $connection['hostname'] );
define( 'DB_PASSWORD', $connection['password'] );
define( 'DB_USERNAME', $connection['username'] );
define( 'DB_NAME',     $connection['database'] );

# define aws credentails
define( 'AWS_ACCESS_KEY_ID',     getenv( 'AWS_ACCESS_KEY_ID'     ));
define( 'AWS_SECRET_ACCESS_KEY', getenv( 'AWS_SECRET_ACCESS_KEY' ));

# define wordpress home/site/yada bullshit
define( 'WP_HOME',  'http://' . getenv( 'CNAME' ) . 'callowayart.com' );
define( 'WP_SITE',  'http://' . getenv( 'CNAME' ) . 'callowayart.com' );

