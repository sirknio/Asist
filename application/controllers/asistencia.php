<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Asistencia extends CI_Controller {
	private $controller = 'asistencia';
	private $pagelist = 'asistencia';
	private $pagecard = 'asistencia';
	private $pkfield = 'idEvento';
	private $orderfield = 'FechaEvento';
	private $imgfield = '';
	private $imgpath = '';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
	}
	
	public function index($ingreso = 0) {
		$this->loadData($data,$this->debug);
		$this->loadHTML($data);

		if($ingreso) {
			$this->load->view('pages/asistingreso',$data);
		} else {
			$this->load->view('pages/asistsalida',$data);
		}
	}	
	
	public function checkEntrance() {
		// echo "<pre>";print_r($_POST);echo "</pre>";
		$this->loadData($data,$this->debug);
		unset($data['success']);
		unset($data['warning']);
		unset($data['error']);
		
		//Query pregunta si ya existe un Ingreso el dia de hoy
		$asistencia = $this->object_model->get($this->controller,'',
			array(
				'DocumentoNo' => $_POST['DocumentoNo'],
				'DATE(RegistroEntrada)' => date('Y-m-d', time()),
				'Ingreso' => $_POST['Ingreso']
			));
		// echo "<pre>";	print_r(count($asistencia));	echo "</pre>";

		//Pregunta si no existe Ingreso
		if((count($asistencia) == 0)) {

			date_default_timezone_set('America/Bogota');
			$date = date('Y-m-d H:i:s', time());
			$timezone = date_default_timezone_get();
			// echo "The current server timezone is: " . $timezone . " ans it's ". $date;
			
			//Query pregunta si existe persona con ese DocumentoNo
			$persona = $this->object_model->get('persona','',array('DocumentoNo' => $_POST['DocumentoNo']));
			
			//Pregunta si existe persona con ese DocumentoNo
			if ((count($persona) > 0 )) {
				$persona = $persona[0];
				// echo "<pre>";print_r($persona);echo "</pre>";
	
				//Query prepara Insert en la tabla
				$asistencia = array(
					'idGrupo' 			=> 0,
					'idPersona' 		=> $persona['idPersona'],
					'RegistroEntrada' => $date,
					'Nombre' 			=> $persona['Nombre'],
					'Apellido' 			=> $persona['Apellido'],
					'DocumentoNo' 		=> $persona['DocumentoNo'],
					'Ingreso'			=> $_POST['Ingreso']
				);
				// echo "<pre>";print_r($asistencia);echo "</pre>";
				
				//INSERT
				$EntryNo = $this->object_model->insertItem($this->controller,$asistencia);
				// echo "<pre>";print_r($EntryNo);echo "</pre>";
				
				//Query pregunta si el Insert fuie correcto
				$asistencia = $this->object_model->get($this->controller,'',array('EntryNo' => $EntryNo));
				// echo "<pre>";print_r($asistencia);echo "</pre>";

				//Pregunta si el Insert fuie correcto
				if (count($asistencia) > 0) {
					$asistencia = $asistencia[0];
					$data['success'] = "<b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b>. ".
						"Su hora de ingreso ha sido registrada exitosamente.";
				}
					
			} else {
				//Prepara mensaje de error si la persona no se encuentra en la lista de empleados
				$data['error'] = 
					"El No. Documento <b>".$_POST['DocumentoNo']."</b> no se encuentra ".
					"en la lista de empleados y su ingreso no puso ser registrado.<br>".
					"Por favor revise con el Administrador del sistema.";
			}
		} else {
			//Prepara mensaje de error si ya se hizo ingreso con ese número de documento.
			//Si quiere hacerse varios ingresos durante el día, debe quitarse este if y reemplazarlo
			//por pregunta si existe un ingreso abierto.
			$data['warning'] = 
				"Su hora de ingreso ya hab&iacute;a sido registrada.";
		}

		$this->loadData($data,$this->debug);
		$this->loadHTML($data);
		$this->load->view('pages/asistingreso',$data);
	}
	
	public function checkExit() {
		$varpost = "<pre>".print_r($_POST,true)."</pre>";
		//echo "<pre>";print_r($_POST);echo "</pre>";
		$this->loadData($data,$this->debug);
		unset($data['success']);
		unset($data['warning']);
		unset($data['error']);
		
		//Query pregunta si hay un ingreso el día de hoy
		$asistencia = $this->object_model->get($this->controller,'',
			array(
				'DocumentoNo' => $_POST['DocumentoNo'],
				'DATE(RegistroEntrada)' => date('Y-m-d', time()),
				//'RegistroSalida' => date('0000-00-00 00:00:00'),
				'Ingreso' => 1
			));
		// echo "<pre>";	print_r($asistencia);	echo "</pre>";

		//Pregunta si hay un ingreso HOY
		if((count($asistencia) > 0)) {
			//Aquí se busca el Entry No. y se actualiza con la última hora
			$asistencia = $asistencia[0];
			
			date_default_timezone_set('America/Bogota');
			$date = date('Y-m-d H:i:s', time());
			$timezone = date_default_timezone_get();
			// echo "The current server timezone is: " . $timezone . " ans it's ". $date;
			
			$this->object_model->updateItem(
				$this->controller,
				array('RegistroSalida' => $date),
				array('EntryNo' => $asistencia['EntryNo']));
			
			$data['success'] = "<b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b>. ".
				"Su hora de salida ha sido registrada exitosamente.";

		} else {
			$data['success'] = "Su No. Documento ".$_POST['DocumentoNo']." no registra un ingreso el día de hoy.";
		}

		$this->loadData($data,$this->debug);
		$this->loadHTML($data);
		$this->load->view('pages/asistsalida',$data);

	}
	
	private function loadData(&$data,$debug = false,$id = '') {
		$data['userdata'] = $_SESSION;
		$print = '';
		if($debug) {
			$print = $data;
		}
		$data['print'] = $print;
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['buttons'] = '';
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}