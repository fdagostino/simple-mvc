<?php 
/* 
 * $res = Paginator::set($query, $filters, $pag_info, 'id ASC');
 * return ($res) ? $res : array();
 *
 * $filters['pag'] pagina actual = parceo de $_GET_['pag']
 * $filters['xpag'] resultados por pagina = parceo de $_GET_['xpag']
 
 * $query = "SELECT SQL_CALC_FOUND_ROWS * FROM test";
 * $res = $db->get_results($query);
 * $total = $db->get_row("SELECT FOUND_ROWS() as total")->total;
 *
 * Retorna un array con dos parametros
		$return['pag_info'] : contiene un array con los datos de la paginacion ( from, to, total, pag, pags )
		$return['result'] : contiene un object con los resultado de la paginación
 */
 
class Paginator extends Model {
	
	public $page;
	
	public $pags;
	
	public $xpag;
	
	public $from;
	
	public $to;
	
	public $total = '0';
	
	public $get_param = 'page';

	function paginar($query) {

		$this->page	= (isset($this->page)) ? (int)$this->page-1 : 0;
		$this->from = $this->page * $this->xpag;

		$total = $this->db->get_results($query);
        $this->total = count($total);

		$query .= " LIMIT $this->xpag OFFSET $this->from ";
		$result = $this->db->get_results($query);

		return $result;
	}

	/*
	function total() {
		return $this->total;
	}
	*/
	
	function from() {
		return ($this->total) ? $this->from + 1 : 0;
	}

	function to() {
		return ($this->from + $this->xpag > $this->total) ? $this->total : $this->from + $this->xpag;
	}
	
	function page() {
		return $this->page + 1;
	}
	
	function pags() {
		return @ceil($this->total / $this->xpag);	
	}

	function link($v="") {
		$parse = parse_url($_SERVER['REQUEST_URI']);
		$path = $parse['path'];
		$path = (substr($path,-1)=="/") ? $path : "$path/";
		
		if(!isset($parse['query'])) 
			$parse['query'] = "";
		
		parse_str($parse['query'], $qs);
		
		if($v===FALSE) 
			unset($qs[$this->get_param]);
		else 
			$qs[$this->get_param] = $v;
			
		return implode('?', array($path, http_build_query($qs))); 
	}
	
}