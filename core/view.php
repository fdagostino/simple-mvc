<?php 
/**
 * Base View
 * @author Gerónimo Ortiz - geronimo@playwebs.net
 * @version 1.0
 */

class View {

	/**
	 * include template file
	 * @param  string  $path  path to file from views folder
	 * @param  array $data  array of data
	 * @param  array $error array of errors
	 */
	
	function render($path, $data = false, $error = false){

	   if (!empty($data))
		   extract($data, EXTR_SKIP);

		unset($data);

		if (file_exists( "app/views/$path.php" )) 
			require "app/views/$path.php";
		elseif(DEBUG) 
			die ('Error al abrir la vista '.$path);

	}

}