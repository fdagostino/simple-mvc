<?php if (!defined('URL')) exit('No direct script access allowed');


/* MODO DE USO
 -------------------------------------------
$data = [
	'nombre'	=> 'Gerónimo',
	'numero'	=> '10',
	'fecha' 	=> '30/11/1985'
];

$rules = [
	'nombre'	=> 'required',
	'numero'	=> 'url',
	'fecha' 	=> 'date:d-m-Y'
];

// Opcional
$custom_messages = [
	'nombre' => 'Mensaje de error personalizado para nombre',
];


$validate = new Validator();
$validate->validate($data, $rules, $custom_messages);

if ($validate->is_valid())
	echo "se cumplen todas las reglas!";
else {
	echo "<pre>";
	print_r( $validate->show_errors() );
}

*/

Class Validator {

	protected $errors = array();

	function  __construct($data, $rules, $custom_msgs = false)  {
	// public function validate($data, $reglas, $mensaje) {

		foreach($data as $key => $value){

			$array_rules = explode('|', $rules[$key]);
			foreach($array_rules as $rule){

				$params = explode(':', $rule);
				if( $params[0] == 'required' or !empty($value)) {

					// Comprobar si la regla tiene parametros
					if(count($params) > 1){
						$result = self::{$params[0]}($key, $value, $params[1]);
						$this->add_error($key, $result, $custom_msgs[$key], $rule);

					} elseif(!empty($params[0])) {
						$result = self::{$params[0]}($key, $value);
						$this->add_error($key, $result, $custom_msgs[$key], $rule);
					}

				}
			}
		}
	}

	public function is_valid(){
		if(count($this->errors) == 0){
			return true;
		} else {
			return false;
		}
	}

	private function add_error($key, $result, $custom_msg){
		if(is_string($result)){
			$this->errors[$key] = ($custom_msg)? $custom_msg : $result;
		}
	}

	public function get_errors($class = false){
		$return = '';
		foreach($this->errors as $error){
			if($class)
				$return .= "<div class='".$class."'>".$error."</div>";
			else
				$return .= "<div>".$error."</div>";
		}
		return $return;
	}

	public function get_errors_list($class = false){

		if($class)
			$return = '<ul class="'.$class.'">';
		else
			$return = '<ul>';

		foreach($this->errors as $error){
			$return .= "<li>".$error."</li>";
		}
		$return.= '<ul>';
		return $return;
	}

	public function get_errors_array(){
		return $this->errors;
	}


	/* MÉTODOS DE VALIDACIÓN
	 ----------------------------------------------- */
	protected function required($key, $value){
		if (isset($value) && ($value === false || $value === 0 || $value === 0.0 || $value === '0' || !empty($value))) {
			return false;
		} else {
			return "$key es un campo requerido.";
		}
	}

	protected function max($key, $value, $param) {
		if ( is_numeric( $value ) && is_numeric( $param ) && ( $value <= $param ) ) {
			return true;
		} else {
			return "$key debe ser un numero menor o igual a $param.";
		}
	}

	protected function min($value, $param, $key){
		if (is_numeric($value) && is_numeric($param) && ($value >= $param)) {
			return true;
		} else {
			return "$key debe ser un numero mayor o igual a $param.";
		}
	}

	protected function max_char($key, $value, $param) {
		if(mb_strlen($value) <= (int)$param){
			return true;
		} else {
			return "<b>$key</b> excede el maximo de $param caracteres.";
		}
	}

	protected function min_char($value, $param, $key){
		if(mb_strlen($value) >= (int)$param){
			return true;
		} else {
			return "$key debe ser mayor a $param caracteres.";
		}
	}

	protected function numeric($key, $value) {
		if (is_numeric($value))
			return true;
			return "$key debe ser un número.";
	}

	protected function email($key, $value) {
		if (filter_var($value, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return "El email ingresado no es correcto.";
	}

	protected function ip($key, $value) {
		if (filter_var($value, FILTER_VALIDATE_IP))
			return true;
		else
			return "La IP ingresada no es correcta.";
	}

	protected function phone($key, $value){
		$regex = '/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i';
		if (preg_match($regex, $value))
			return true;
		else
			return "El teléfono ingresado no es correcto.";
	}

	protected function date($key, $date, $format = 'Y-m-d H:i:s'){
		$d = DateTime::createFromFormat($format, $date);
		if ($d && $d->format($format) == $date)
			return true;
		else
			return "El campo {$key} no es una fecha válida.";
	}

	protected function url($key, $value){
		if (filter_var($value, FILTER_VALIDATE_URL))
			return true;
		else
			return "El campo {$key} no es una url válida.";
	}

	protected function is_array($key, $value){
		if (is_array($value))
			return true;
		else
			return "El campo {$key} no es una url válida.";
	}

}