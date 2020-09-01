<?php if (!defined('URL')) exit('No direct script access allowed'); 

Class getCurrent {

  	/**
     * Checks if the passed string is the currently uri.
     * Useful for handling the navigation's active/non-active link.
     * Ej: <a href="/perros" class="<?=getCurrent:route('perros','active')?>"> perros </a>
     * @param string $names acepta múltiples valores separados por coma
     * @param string $return nombre de la clase a retornar
     * @return bool (true|false) o el valor de $return en el caso de que esté declarado
     */
	public static function controller($names, $return=false) {
	
		$names = explode(",", $names);
		$names = array_map('trim',$names);
		global $controller;
		if(in_array($controller, $names))
			return ($return)? $return : true;
		else
			return false;
	}

	/**
	 * GetCurrent name: compara la url actual con los parámetros $names 
	 * Si encuentra una coincidencia devuelve un string con el valor del parametro $class
	 * 
	 * @static
	 * @access public
	 * @param  string $names (separados por coma)
	 * @param  string $class (valor de retorno)
	 * @return string
	 *
	 * usage: <?=GetCurrent::name('name1, name2','class');?>
	 *
	 */	
	public static function name($names, $class) {
		$names = explode(",", $names);
		foreach ($names as $name) {
			if ($_SERVER['REQUEST_URI'] == trim($name)){
				return $class;
			}
		}
	}

	public static function method($names, $return=false) {
		$names = explode(",", $names);
		$names = array_map('trim', $names);
		global $method;

		if(in_array($method, $names)) {
			return ($return)? $return : true;
		} else {
			return false;
		}
	}

	/**
     * Get current Uri
     * @return string

    public static function uri() {

        // Get the current Request URI and remove rewrite basepath from it (= allows one to run the router in a subfolder)
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));

        // Don't take query params into account on the URL
        if (strstr($uri, '?')) 
        	$uri = substr($uri, 0, strpos($uri, '?'));

	    // Get Subdominio
	    $partes = explode(".", $_SERVER['SERVER_NAME']);
	    if(count($partes) >= 3) {
		    return URL.$uri;
	    } else {
		    return URL.$uri;
	    }

    }

	/**
	 * Get current Uri
	 * @return string

	public static function uri() {

		// Get the current Request URI and remove rewrite basepath from it (= allows one to run the router in a subfolder)
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
		$uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));

		// Don't take query params into account on the URL
		if (strstr($uri, '?'))
			$uri = substr($uri, 0, strpos($uri, '?'));

		return $uri;
	}
	 */


}