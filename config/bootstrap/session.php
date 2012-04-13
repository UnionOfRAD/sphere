<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * This configures your session storage. The Cookie storage adapter must be connected first, since
 * it intercepts any writes where the `'expires'` key is set in the options array.
 */
use lithium\storage\Session;

$redis = array(
	'session.save_handler' => 'redis',
	'session.save_path' => 'tcp://4cfbe0439d177feda6e7390e1f14fce1@drum.redistogo.com:9148'
);

Session::config(array(
	'cookie' => array('adapter' => 'Cookie'),
	'li3_user' => array('adapter' => 'Php') + $redis,
	'default' => array('adapter' => 'Php') + $redis,,
	'cooldown' => array('adapter' => 'Php', 'expires' => 10) + $redis,
));

?>