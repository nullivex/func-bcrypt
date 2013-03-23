<?php
require_once(dirname(__DIR__).'/vendor/autoload.php');
require_once('boot.php');
ld('/func/bcrypt');

class FuncBcryptTest extends PHPUNIT_Framework_TestCase {

	public function testBcrypt(){
		$hash = bcrypt('password');
		$this->assertTrue(bcrypt_check('password',$hash));
	}

}
