<?php

class index_controller extends Controller {

	public function __construct() {
		
	}

	public function index() {
		$data = array();
		View::render('index', $data );
    }

}