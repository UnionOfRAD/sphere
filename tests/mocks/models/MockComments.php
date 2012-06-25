<?php

namespace app\tests\mocks\models;

class MockComments extends \app\models\Comments {

	protected static $_classes = array(
		'session' => 'app\tests\mocks\extensions\storage\MockSession'
	);
}

?>