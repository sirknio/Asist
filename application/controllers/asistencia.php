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
		
		$asistencia = $this->object_model->get($this->controller,'',
			array(
				'DocumentoNo' => $_POST['DocumentoNo'],
				'DATE(FechaHoraRegistro)' => date('Y-m-d', time()),
				'Ingreso' => $_POST['Ingreso']
			));
		// echo "<pre>";	print_r(count($asistencia));	echo "</pre>";

		if((count($asistencia) == 0)) {
			date_default_timezone_set('America/Bogota');
			$date = date('Y-m-d H:i:s', time());
			$timezone = date_default_timezone_get();
			// echo "The current server timezone is: " . $timezone . " ans it's ". $date;
			
			$persona = $this->object_model->get('persona','',array('DocumentoNo' => $_POST['DocumentoNo']));
			if ((count($persona) > 0 )) {
				$persona = $persona[0];
				// echo "<pre>";print_r($persona);echo "</pre>";
	
				$asistencia = array(
					'idGrupo' 			=> 0,
					'idPersona' 		=> $persona['idPersona'],
					'FechaHoraRegistro' => $date,
					'Nombre' 			=> $persona['Nombre'],
					'Apellido' 			=> $persona['Apellido'],
					'DocumentoNo' 		=> $persona['DocumentoNo'],
					'Ingreso'			=> $_POST['Ingreso']
				);
				// echo "<pre>";print_r($asistencia);echo "</pre>";
				
				$EntryNo = $this->object_model->insertItem($this->controller,$asistencia);
				// echo "<pre>";print_r($EntryNo);echo "</pre>";
				
				$asistencia = $this->object_model->get($this->controller,'',array('EntryNo' => $EntryNo));
				// echo "<pre>";print_r($asistencia);echo "</pre>";

				if (count($asistencia) > 0) {
					$asistencia = $asistencia[0];
					$data['success'] = "<b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b>. ".
						"Su hora de ingreso ha sido registrada exitosamente.";
				}
					
			} else {
				$data['error'] = 
				"El No. Documento <b>".$_POST['DocumentoNo']."</b> no se encuentra y su ingreso".
				" no puso ser registrado."."Por favor revise con el Adminsitrador del sistema.";
			}
		} else {
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
		
		$asistencia = $this->object_model->get($this->controller,'',
			array(
				'DocumentoNo' => $_POST['DocumentoNo'],
				'DATE(FechaHoraRegistro)' => date('Y-m-d', time()),
				'Ingreso' => 1
			));
		// echo "<pre>";	print_r(count($asistencia));	echo "</pre>";

		if((count($asistencia) > 0)) {
			$dateEntrance = $asistencia[0]['FechaHoraRegistro'];
			$asistencia = $this->object_model->get($this->controller,'',
				array(
					'DocumentoNo' => $_POST['DocumentoNo'],
					'FechaHoraRegistro >' => date('Y-m-d 00:00', strtotime($dateEntrance)),
					'Ingreso' => 0
				));
			// echo "<pre>";	print_r(count($asistencia));	echo "</pre>";
	
			if((count($asistencia) == 0)) {
				date_default_timezone_set('America/Bogota');
				$date = date('Y-m-d H:i:s', time());
				$timezone = date_default_timezone_get();
				// echo "The current server timezone is: " . $timezone . " ans it's ". $date;
				
				$persona = $this->object_model->get('persona','',array('DocumentoNo' => $_POST['DocumentoNo']));
				if ((count($persona) > 0 )) {
					$persona = $persona[0];
					// echo "<pre>";print_r($persona);echo "</pre>";
		
					$asistencia = array(
						'idGrupo' 			=> 0,
						'idPersona' 		=> $persona['idPersona'],
						'FechaHoraRegistro' => $date,
						'Nombre' 			=> $persona['Nombre'],
						'Apellido' 			=> $persona['Apellido'],
						'DocumentoNo' 		=> $persona['DocumentoNo'],
						'Ingreso'			=> $_POST['Ingreso']
					);
					// echo "<pre>";print_r($asistencia);echo "</pre>";
					
					$EntryNo = $this->object_model->insertItem($this->controller,$asistencia);
					// echo "<pre>";print_r($EntryNo);echo "</pre>";
					
					$asistencia = $this->object_model->get($this->controller,'',array('EntryNo' => $EntryNo));
					// echo "<pre>";print_r($asistencia);echo "</pre>";
	
					if (count($asistencia) > 0) {
						$asistencia = $asistencia[0];
						$data['success'] = "<b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b>. ".
							"Su hora de salida ha sido registrada exitosamente.";
					}
						
				} else {
					$data['error'] = 
					"El No. Documento <b>".$_POST['DocumentoNo']."</b> no se encuentra.".
					"Por favor verifique su No. Documento.";
				}
			} else {
				//Aquí se busca el Entry No. y se actualiza con la última hora
				$asistencia = $asistencia[0];
	
				date_default_timezone_set('America/Bogota');
				$date = date('Y-m-d H:i:s', time());
				$timezone = date_default_timezone_get();
				// echo "The current server timezone is: " . $timezone . " ans it's ". $date;
	
				$this->object_model->updateItem(
					$this->controller,
					array('FechaHoraRegistro' => $date),
					array('EntryNo' => $asistencia['EntryNo']));
				
				$data['success'] = "<b>".$asistencia['Nombre']." ".$asistencia['Apellido']."</b>. ".
					"Su hora de salida ha sido registrada exitosamente.";
			}
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