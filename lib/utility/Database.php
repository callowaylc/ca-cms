<?php
# author:      chrisitan calloway admin@callowayart.com
# description: parses database uri string that usually provided in env
# usage:
# parse_database_uri 'scheme://$username:$password@$hostname/$database'
namespace callowayart\utility;

class Database {
  public function parse_uri( $uri ) {

    // define regular expression and hash keys
    // to find database credentials
    $credentials = array();
    $matches     = array(
      'scheme'   => '#^(?<scheme>.+?)://#',
      'username' => '#//(?<username>.+?)(\:|\@)#',
      'password' => '#\:(?<password>[^\/]*?)\@#',
      'hostname' => '#\@(?<hostname>.+?)/#',
      'database' => '#\@.+?/(?<database>.+)#'
    );

    // iterate through dataqbase credentials, perform lookup
    // and add result back to credentails store
    // @TODO we need to explicitly check for nil values and
    // exceptional events; for right now, a leap of faith is fine
    foreach($matches as $key => $regex) {
      preg_match( $regex, $uri, $match );

      $credentials[$key] = $match[$key]; 
    }

    return $credentials;
  }

}