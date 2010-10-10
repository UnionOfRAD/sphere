<?php

namespace app\tests\cases\models;

use \app\models\Post;
use \lithium\data\Connections;
use \lithium\data\model\Query;
use \lithium\util\Inflector;

class PostTest extends \lithium\test\Unit {

	public function setUp() {
		Post::__init(array('connection' => 'test'));
	}

	public function tearDown() {
		// foreach (Post::all() as $post) {
		// 	/$post->delete();
		// }
		//Connections::get('test')->delete(new Query(array('model' => '\app\models\Post')));
	}

	public function testSave() {
		$model = Post::create(array('title' => 'the title', 'content' => 'the content'));
		$data = $model->data();
		$expected = Inflector::slug($model->title);

		$save = $model->save();
		$data = $model->data();
		$result = $model->id;

		$this->assertEqual($expected, $result);

		$expected = $content = 'updated content';
		$model->save(compact('content'));

		$model = Post::first($model->id);

		$this->assertEqual($expected, $model->content);
	}
	//
	// public function testComment() {
	// 	$post = Post::create(array('title' => 'another title', 'content' => 'the content'));
	// 	$post->save();
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$data = array(
	// 		'content' => 'cool',
	// 		'user' => array(
	// 			'id' => 'gwoo@somewhere.com', 'username' => 'gwoo', 'email' => 'gwoo@somewhere.com'
	// 		)
	// 	);
	// 	$args = null;
	// 	$result = $post->comment(compact('data', 'args'));
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 1;
	// 	$result = count($post->comments);
	// 	$this->assertEqual($expected, $result);
	//
	// 	$comment = $post->comments->first();
	// 	$expected = 'cool';
	// 	$result = $comment['content'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$data = array(
	// 		'content' => 'super cool',
	// 		'user' => array(
	// 			'id' => 'gwoo@somewhere.com', 'username' => 'gwoo', 'email' => 'gwoo@somewhere.com'
	// 		)
	// 	);
	// 	$args = array('0');
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$comment = $post->comments->first();
	// 	$expected = 1;
	// 	$result = $comment['comment_count'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 1;
	// 	$result = count($post->comments->first()->comments);
	// 	$this->assertEqual($expected, $result);
	//
	// 	$comments = $post->comments->first()->comments->data();
	// 	$expected = 'super cool';
	// 	$result = $comments[0]['content'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$data = array(
	// 		'content' => 'nice',
	// 		'user' => array(
	// 			'id' => 'gwoo@somewhere.com', 'username' => 'gwoo', 'email' => 'gwoo@somewhere.com'
	// 		)
	// 	);
	// 	$args = array('0');
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$comment = $post->comments->first();
	// 	$expected = 2;
	// 	$result = $comment['comment_count'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 2;
	// 	$result = count($post->comments->first()->comments);
	// 	$this->assertEqual($expected, $result);
	//
	//
	// 	$comments = $post->comments->first()->comments->data();
	// 	$expected = 'nice';
	// 	$result = $comments[1]['content'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 'gwoo';
	// 	$result = $comments[1]['user']['username'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 'gwoo@somewhere.com';
	// 	$result = $comments[1]['user']['email'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$data = array(
	// 		'content' => 'super nice',
	// 		'user' => array(
	// 			'id' => 'gwoo@somewhere.com', 'username' => 'gwoo', 'email' => 'gwoo@somewhere.com'
	// 		)
	// 	);
	// 	$args = array('0', '0');
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$comment = $post->comments->first();
	// 	$expected = 3;
	// 	$result = $comment['comment_count'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 2;
	// 	$result = count($post->comments->first()->comments);
	// 	$this->assertEqual($expected, $result);
	//
	// 	$comments = $post->comments->first()->comments->data();
	// 	$expected = 'super nice';
	// 	$result = $comments[0]['comments'][0]['content'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 'gwoo';
	// 	$result = $comments[0]['comments'][0]['user']['username'];
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 'gwoo@somewhere.com';
	// 	$result = $comments[0]['comments'][0]['user']['email'];
	// 	$this->assertEqual($expected, $result);
	// }
	//
	// public function testEndorse() {
	// 	$post = Post::create(array('title' => 'another title', 'content' => 'the content'));
	// 	$post->save();
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$author = array(
	// 		'id' => 'gwoo@somewhere.com', 'username' => 'gwoo', 'email' => 'gwoo@somewhere.com'
	// 	);
	// 	$args = null;
	// 	$data = array('content' => 'ok', 'user' => $author);
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$result = $post->endorse(compact('author', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 1;
	// 	$result = count($post->endorsements);
	// 	$this->assertEqual($expected, $result);
	//
	// 	$args = array('0');
	// 	$data = array('content' => 'nice', 'user' => $author);
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$result = $post->endorse(compact('author', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 1;
	// 	$result = count($post->comments->first()->endorsements);
	// 	$this->assertEqual($expected, $result);
	//
	// 	$args = array('0', '0');
	// 	$data = array('content' => 'super nice', 'user' => $author);
	// 	$result = $post->comment(compact('data', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$result = $post->endorse(compact('author', 'args'));
	// 	$this->assertTrue($result);
	//
	// 	$post = Post::find($post->id);
	// 	$expected = 'the content';
	// 	$result = $post->content;
	// 	$this->assertEqual($expected, $result);
	//
	// 	$expected = 1;
	// 	$result = count($post->comments->first()->comments->first()->endorsements);
	// 	$this->assertEqual($expected, $result);
	// }
	//
	// public function testRating() {
	// 	$this->testEndorse();
	// 	$post = Post::find('another-title');
	//
	// 	$expected = 5.5;
	// 	$result = $post->rating();
	// 	$this->assertEqual($expected, $result);
	// }

}

?>