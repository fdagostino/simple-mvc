<?php if (!defined('URL')) exit('No direct script access allowed');

/**
 * Auth Class - Check login
 */
 
class Auth {


	/**
	 * Check Login
	 * @return TRUE or redirect to login
	 */
	public static function check_login($level = false) {

		if ( empty($_SESSION['user_id']) || $_SESSION['token'] != sha1( $_SESSION['user_name'] . HASH ) ) {
			self::redirect();
		}
		elseif( !empty($level) && $_SESSION['user_level'] != $level) {
			self::redirect();
		}
		else {
			return true;
		}

	}
	
	private function redirect() {
		// $_SESSION['redirect'] = getCurrent::uri();
		header("Location: ".URL."login");
	}
	
	public static function logout() {
  		session_unset();
		session_destroy();
		header('Location: '.URL.'login');
	}

}