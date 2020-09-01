<?php

class Slug extends Model {
	
	/* $nombre(string) 
	 * Generar url limpia a partir del nombre recibido
	 */
	function get_slug($nombre){
		
		$url = strtolower($nombre);
		
		// Rememplazar caracteres especiales latinos
		$find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
		$repl = array('a', 'e', 'i', 'o', 'u', 'n');
		$url = str_replace($find, $repl, $url);
		
		// Añadir guiones
		$find = array(' ', '&', '\r\n', '\n', '+'); 
		$url = str_replace ($find, '-', $url);
		
		// Eliminar y Reemplazar caracteres especiales
		$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
		$repl = array('', '-', '');
		$url = preg_replace ($find, $repl, $url);

		return $url;
		
	}
	
	
	/* $slug (string) 
	 * $table (string)
	 * Comprobar si ya existe una url con el mismo nombre en la tabla recibida
	 */
	function uniqueSlug($slug, $table) {

		$newslug = $slug;
		$i = 0;
				
		while(@!$finish) {
			$i++;
			$query = $this->db->get_row("SELECT slug FROM ".PREFIX.$table." WHERE slug = '$newslug'");
			
			if(@$query->slug == $newslug) {
				$newslug = $slug."-".$i;
			} else {
				$newslug = $newslug;
				$finish = true;
			}
		}
		return $newslug;
	}
	
}
