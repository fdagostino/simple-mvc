<?php


class Model {

	protected $db;

	public function __construct() {

		if ( DB_EXT == 'pdo' ) {

			$this->db = new ezSQL_pdo();
			$this->db->quick_connect(
				'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST,
				DB_USER, DB_PASS,
				array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" )
			);

		} elseif ( DB_EXT == 'mysqli' ) {

			$this->db = new ezSQL_mysqli();
			$conn = $this->db->quick_connect(DB_USER,DB_PASS,DB_NAME,DB_HOST,DB_PORT,'utf8');
		}


		if(!$conn && DEBUG){
			die ('Error de conexion a la base de datos');
		}



	}
}
