<?php
/**
 * Orchestra.io Bootstap for Lithium
 * 
 * add `require __DIR__ . '/bootstrap/orchestra.php';` immediately after 
 * `require __DIR__ . '/bootstrap/libraries.php';` in bootstrap.php
 */
use lithium\core\Libraries;
use lithium\action\Dispatcher;

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	$params['request']->url = "";

	if (isset($_SERVER['REQUEST_URI']) && strlen(trim($_SERVER['REQUEST_URI'])) > 0) {
		$params['request']->url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
	return $chain->next($self, $params, $chain);
});

$resources = str_replace("//", "/", sys_get_temp_dir() . '/resources');

if (!is_dir($resources)) {
	mkdir($resources, 0777, true);
	mkdir("{$resources}/logs", 0777, true);
	mkdir("{$resources}/tmp/cache/templates", 0777, true);
}
Libraries::add('app', array('default'=> true, 'resources' => $resources));