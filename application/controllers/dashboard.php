<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Dashboard extends CI_Controller {
	private $debug = false;
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->library('statistics');
	}
	
	public function index($id = '') {
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/dashboard',$data);
	}

	public function exportEntrances() {
		$file="ExportIngresos.xls";
		$this->loadData($data,$this->debug);
		$data['data'] = $data['RegistrosIngresos'];
		$export = $this->load->view('reports/tablebuilder',$data,true);
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$file");
		echo $export;
	}

	public function exportDelays() {
		$file="ExportRetrasos.xls";
		$this->loadData($data,$this->debug);
		$data['data'] = $data['Registrosretardos'];
		$export = $this->load->view('reports/tablebuilder',$data,true);
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$file");
		echo $export;
	}

	private function loadData(&$data,$debug = false,$id = '') { 
		$data['userdata'] = $_SESSION;
		$data['setupapp'] = $this->object_model->getSetup(); 
		$data['date'] = '';

		//INGRESOS REGISTRADOS
		$asistencia = $this->object_model->get('asistencia','',
			array(
				'DATE(RegistroEntrada)' => date('Y-m-d', time()),
				'Ingreso' => 1
			));
		//$print = "<pre>".print_r($asistencia,true)."</pre>";

		$data['ingresos'] = count($asistencia);
		$data['RegistrosIngresos'] = $asistencia;
		
		//RETARDOS REGISTRADOS
		$date = date('Y-m-d '.$data['setupapp']['LVHoraEntrada'], time());
		//$date = date('Y-m-d 13:52:29', time());
		$asistencia = $this->object_model->get('asistencia','',
			array(
				'RegistroEntrada >' => $date,
				'Ingreso' => 1
			));
		//$print = "<pre>".print_r($data['setupapp']['LVHoraEntrada'],true)."</pre>";
		$print = "<pre>".print_r($asistencia,true)."</pre>";
		//echo $print;

		$data['retardos'] = count($asistencia);
		$data['Registrosretardos'] = $asistencia;
		
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		$data['page']['buttons'] = '';
		$data['page']['ingresos'] = $data['ingresos'];
		$data['page']['retardos'] = $data['retardos'];
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
}


?>