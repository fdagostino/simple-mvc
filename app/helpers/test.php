<?php if (!defined('URL')) exit('No direct script access allowed'); 
	
class Test_helper extends Model {
	
	// Load Model
	function __construct(){
		parent::__construct();
	}
	
	function say_hellow() {
		// $model = Controller::loadModel('test');
		// $model = $model->get();
		return 'Hello Word!';
	}

}
