<?php if (!defined('URL')) exit('No direct script access allowed');

/**
 * Base Controller
 * @author Gerónimo Ortiz - geronimo@playwebs.net
 * @version 1.0
 */

class Controller {

	/**
	 * Run Controller
	 */
	public static function load($name, $function=false, $params=array(), $lang=false) {

		global $controller;

		$name = str_replace("-", "_", $name);
		$controller = $name;

		if (!$function){
			$function = 'index';
		} else {
			$function = str_replace("-", "_", $function);
		}

		global $method;
		$method = $function;

		$name = $name.'_controller';
		$path = 'app/controllers/'.$name.'.php';

		if (!$function)
			$function = 'index';

		if (file_exists($path)) {
			require_once $path;
			$parts = explode('/',$name);
			$className = end($parts); // ucwords(end($parts));
			$instance = new $className;
			if (method_exists($className, $function))
				call_user_func_array(array($instance, $function), $params);
			else {
				if(DEBUG)
					die ('El método <b>'.$function.'</b> no existe en <b>'.$className.'</b>');
				else
					View::render('404');
			}
		} else {
			if(DEBUG)
				die ('Error al abrir el controller '.$path);
			else
				View::render('404');
		}
		
	}	
		
	/**
	 * LoadModel
	 */
	public static function loadModel($name) {

		$name = $name.'_model';
		$path = 'app/models/'.$name.'.php';

		if (file_exists($path)) {
			require_once $path;
			$parts = explode('/',$name); // break name into sections based on a / 
			$modelName = end($parts); // use last part of array
			return new $modelName();
		} else {
			if(DEBUG)
				die ('Error al abrir el modelo '.$modelName);
		}
	}

}