<?php
/**
 * Lithium Sphere: communized sphere of influence
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://www.opensource.org/licenses/MIT The MIT License
 */

namespace li3_users\tests\cases\models;

use lithium\data\Connections;
use lithium\data\model\Query;

class Users extends \li3_users\models\Users {

	protected $_meta = array(
		'key' => '_id',
		'name' => null,
		'title' => null,
		'class' => null,
		'locked' => true,
		'source' => 'users',
		'connection' => 'test',
		'initialized' => false
	);

}

class UsersTest extends \lithium\test\Unit {

	public function setUp() {}

	public function tearDown() {
		Users::find('all')->each(function($i) {
			$i->delete();
		});
	}

	public function testToken() {
		$data = array(
			'_id' => 'username',
			'email' => 'user@example.com',
			'password' => 'my_password'
		);
		$user = Users::create();
		$user->save($data);

		$this->assertTrue(empty($user->token));
		$this->assertTrue(empty($user->expires));

		$token = $user->token();

		$this->assertTrue(!empty($token));
		$this->assertEqual($token, $user->token);

		$this->assertTrue(!empty($user->expires));

		$result = $user->token(strtotime('March 15, 1983'));

		$expected = md5(
			md5($data['_id']) . md5($data['password']) . md5(strtotime('March 15, 1983'))
		);
		$this->assertEqual($expected, $result);

		$expected = strtotime('1983-03-15 00:10:00');
		$this->assertEqual($expected, $user->expires->sec);

	}

	public function testReset() {
		$data = array(
			'_id' => 'username',
			'email' => 'user@example.com',
			'password' => 'my_password'
		);

		$result = Users::reset();
		$expected = false;
		$this->assertEqual($expected, $result);

		$user = Users::create();
		$user->save($data);

		$token = $user->token();

		$result = Users::reset(compact('token'));
		$this->assertFalse($result);

		$_id = $data['_id'];

		$result = Users::reset(compact('_id'));
		$this->assertFalse($result);

		$result = Users::reset(compact('token','_id'));
		$this->assertTrue($result);

		$token = $user->token(strtotime('-15 minutes'));
		$result = Users::reset(compact('token','_id'));
		$this->assertFalse($result);

	}
}

?>