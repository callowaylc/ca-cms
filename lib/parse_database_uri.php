<?php
# author:      chrisitan calloway admin@callowayart.com
# description: parses database uri string that usually provided in env
# usage:
# parse_database_uri 'scheme://$username:$password@$hostname/$database'
namespace callowayart;

function parse_database_uri( $uri ) {


  return false;
  // define regular expression and hash keys
  // to find database credentials
  $credentials = array();
  $matches     = array(
    'username' => '#//(.+?)(\:|\@)#',
    'password' => '#\:([^\/]*?)\@#',
    'hostname' => '#\@(.+?)/#',
    'database' => '#\@.+?/(.+?)\?#'
  );

  // iterate through dataqbase credentials, perform lookup
  // and add result back to credentails store
  // @TODO we need to explicitly check for nil values and
  // exceptional events; for right now, a leap of faith is fine
  foreach($matches as $key => $regex) {
    preg_match( $regex, $uri, $match );
    $credentials[$key] = isset($match[1]) 
      ? $match[1]
      : ''; 
  }

} 