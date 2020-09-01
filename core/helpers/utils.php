<?php if (!defined('URL')) exit('No direct script access allowed'); 

/**
 * Librería de pequeñas funciones útiles ...
 *  
 *	truncate()
 *  
 *	checkEmailDomain()
 *  
 * 	getCoords()
 *  
 *	dirSize()
 *
 */

Class Utils {

	/**
	 * @param $string : cadena de texto a cortas
	 * @param $limit : cantidad máxima de caracteres
	 * @param $break :   (opcional)
	 * @param $pad :  simbolo de finalización (opcional)
	 * @return string
	 *
	 * Ejemplo de uso:
 	 * $text = Utils::truncate($text, 400, " ", "...");
 	 *
	 */
	public static function truncate($string, $limit, $break=".", $pad="…") {

		if (strlen($string) <= $limit)
			return $string;
		
		if ( false !== ($breakpoint = strpos($string, $break, $limit)) ) {
			if($breakpoint < strlen($string)-1) 
				$string = substr($string, 0, $breakpoint) . $pad;
		}
		
		return $string;
	}
	
	/**
	 * Comporbar si el dominio de un email existe.
	 * @param $email : dirección de email válida
	 * @return boolean (true|false)
	 */
	public static function checkEmailDomain($email)
	{
		if(preg_match('/^([a-zA-Z0-9_])+([a-zA-Z0-9\.+_-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email))
		{
			list($username,$domain)=split('@',$email);
			if(!checkdnsrr($domain,'MX')) {
				return false;
			}
			return true;
		}
		return false;
	}
	

	/**
	 * Obtiene las coordenadas a partir de una dirección física
	 * @param string $address (eg: av pueyrredon 848, buenos aires, argentina)
	 * @return array
	 */
	public static function getCoords($address)
	{
	    if (!is_string($address)) die("All Addresses must be passed as a string");
	    $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
	    $_result = false;
	    if($_result = file_get_contents($_url)) {
	        if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
	        preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
	        $_coords['lat'] = $_match[1];
	        $_coords['long'] = $_match[2];
	    }
	    return $_coords;
	}


	/** 
	 * Obtiene el peso en bytes de un directorio (y sus subdirectorios) 
	 * @param $directory : ruta del directorio
	 * @return integer 
	 */ 
	public static function dirSize($directory)
	{ 
	    $size = 0;
	    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
	        $size+=$file->getSize();
	    }
	    
	    return round($size/1024/1024,2);
	} 
	
	/*
	 * Detect Mobile
	 * @return boolean (true|false)
	 */
	public static function isMobile() {
    	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

	/*
	 * Comprobar si una fecha es válida
	 * @return boolean (true|false)
	 * */
	public static function isDate($date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}

	/*
	 * Obtener el nombre del mes abreviado en el idioma correspondiente.
	 * $month INT
	 * @return varchar
	 */
	public static function getMonthName($month)
	{
		if ( $month == 1 )
			return __("Ene");
		elseif ( $month == 2 )
		 	return __("Feb");
		elseif ( $month == 3 )
		 	return __("Mar");
		elseif ( $month == 4 )
		 	return __("Abr");
		elseif ( $month == 5 )
		 	return __("May");
		elseif ( $month == 6 )
		 	return __("Jun");
		elseif ( $month == 7 )
		 	return __("Jul");
		elseif ( $month == 8 )
		 	return __("Ago");
		elseif ( $month == 9 )
		 	return __("Sep");
		elseif ( $month == 10 )
		 	return __("Oct");
		elseif ( $month == 11 )
		 	return __("Nov");
		elseif ( $month == 12 )
		 	return __("Dic");
		else 
			return false;	
	}
	
	public static function getMonthFullName($month)
	{
		if ( $month == 1 )
			return __("Enero");
		elseif ( $month == 2 )
		 	return __("Febrero");
		elseif ( $month == 3 )
		 	return __("Marzo");
		elseif ( $month == 4 )
		 	return __("Abril");
		elseif ( $month == 5 )
		 	return __("Mayo");
		elseif ( $month == 6 )
		 	return __("Junio");
		elseif ( $month == 7 )
		 	return __("Julio");
		elseif ( $month == 8 )
		 	return __("Agosto");
		elseif ( $month == 9 )
		 	return __("Setiembre");
		elseif ( $month == 10 )
		 	return __("Octubre");
		elseif ( $month == 11 )
		 	return __("Noviembre");
		elseif ( $month == 12 )
		 	return __("Diciembre");
		else 
			return false;
	}

	public static function getDayName($day)
	{
		if ( $day == 1 )
			return __("Lunes");
		elseif ( $day == 2 )
		 	return __("Martes");
		elseif ( $day == 3 )
		 	return __("Miércoles");
		elseif ( $day == 4 )
		 	return __("Jueves");
		elseif ( $day == 5 )
		 	return __("Viernes");
		elseif ( $day == 6 )
		 	return __("Sábado");
		elseif ( $day == 7 )
		 	return __("Domingo");
		else 
			return false;	
	}
	
	/*
	 * Obtener el ultimo día del mes
	 */
	public static function getLastDay($yyyy,$mm) {
		return date("d",(mktime(0, 0, 0, $mm+1, 1, $yyyy)-1));
	}

}
