<?php

namespace app\tests\mocks\models;

class MockPosts extends \app\models\Posts {

	protected $_meta = array(
		'connection' => 'test',
		'source' => 'test_posts'
	);

	protected static $_classes = array(
		'users'    => 'app\tests\mocks\models\MockUsers',
		'session' => 'app\tests\mocks\extensions\storage\MockSession',
		'comments' => 'app\tests\mocks\models\MockComments'
	);
}

?>