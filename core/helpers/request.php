<?php if (!defined('URL')) exit('No direct script access allowed'); 

/*
	Request::is_post();
	Request::is_ajax();
*/

Class Request {
	
	public static function is_post() {
		if($_SERVER['REQUEST_METHOD'] == 'POST')
			return true;
		else
			return false;
	}
	
	public static function is_ajax(){
		if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
			return true;
		else
			return false;
	}

}

