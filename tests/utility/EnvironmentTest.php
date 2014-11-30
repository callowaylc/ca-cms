<?php
# author:      chrisitan calloway admin@callowayart.com
# description: checks if required env variables are available
namespace callowayart\test\utility;

class EnvironmentTest extends \PHPUnit_Framework_TestCase {

  function __construct() {
    # load .env
    # TODO: need to account for application root
    try { 
      \Dotenv::load( '.' );
      
    } catch(\Exception $swallow) { }
  }

  # tests that required environment variables are present
  public function test_environment_variables_present() {
    foreach ($this->required() as $variable) {
      $this->assertTrue(getenv( $variable ) !== false);
    }

  }

  private function required() {
    return [
      'DATABASE_URI',               
      'CNAME',               
      'AWS_ACCESS_KEY_ID',     
      'AWS_SECRET_ACCESS_KEY'      
    ];
  }
}