<?php

// Documentation: https://github.com/bramus/router 
	
$router = new \Bramus\Router\Router();

// Default index
$router->match('GET|POST', '/', function() {
 	// Auth::check_login();
	Controller::load('index');
});

/* Generic structure (domain.com/controller/function/parameters)
- - - - - - - - - - - - - - - - - - - - - - - - - - - */
$router->match('GET|POST', '/([a-z0-9_-]+)(/[a-z0-9_-]+)?(/[a-z0-9_-]+)?(/\d+)?', function($controller, $function, $p1, $p2){
	// Auth::check_login();
	Controller::load( $controller, $function, [$p1, $p2] );
});

/* Custom structure example
- - - - - - - - - - - - - - - - - - - - - - - - - - - 
	$router->get('/logout', function() {
		Auth::logout();
	});
	$router->match('GET|POST', '/login', function() {
		Controller::load('login');
	});
	$router->match('GET|POST','/login/change-password(/[a-z0-9_-]+)', function($hash) {
		Controller::load('login', 'change_password', [$hash] );
	});
*/

$router->set404(function() {
	header("HTTP/1.0 404 Not Found");
	View::render('404');
});

