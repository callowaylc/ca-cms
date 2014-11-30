<?php
# author:      chrisitan calloway admin@callowayart.com
# description: parses database uri string that usually provided in env
# usage:
# parse_database_uri 'scheme://$username:$password@$hostname/$database'
namespace callowayart\test\utility;

use callowayart\utility;

class Database extends \PHPUnit_Framework_TestCase {

  const URI = 'scheme://username:password@www.host.com/database_name';

  public function test_parse_uri() {
    $info = ( new utility\Database )->parse_uri( self::URI );
    
    # assert that five elements have been parsed
    $this->assertCount( 5, $info );

    # assert element values and keys
    foreach ($this->parts() as $index => $name) {
      $this->assertArrayHasKey( $name, $info );
      $this->assertEquals( $name, $info[$name] );
    }

  }

  private function utility() {
    return new utility\Database;
  }

  private function uri() {
    $a = $this->parts();

    return sprintf(
      '%s://%s:%s@%s/%s', ...( $this->parts() )
    );
  }

  private function parts() {
    return [ 
      'scheme', 'username', 'password', 'www.host.com', 'database_name'
    ];
  }
}