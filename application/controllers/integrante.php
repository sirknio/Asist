<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Integrante extends CI_Controller {
	private $controller = 'integrante';
	private $tablename = 'persona';
	private $pagelist = 'integrantes';
	private $pagesquare = 'integrantes-square';
	private $pagecard = 'integrante';
	private $pkfield = 'idPersona';
	private $orderfield = 'Nombre';
	private $imgfield = 'foto';
	private $imgpath = 'integrantes';
	private $debug = false;

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('integrante_model');
	}
	
	public function index($idGrupo = '',$idMicro = '',$id = '' ) {
		$data['insert'] = false;
		$data['update'] = false;
		//echo"<pre>";print_r($idGrupo." - ".$idMicro." - ".$id);echo"</pre>";
		$this->loadData($data,$this->debug,$id);
		$this->loadHTML($data);
		$this->load->view('pages/'.$this->pagelist,$data);
	}	
		
	//Eliminar registro
	public function deleteItem() {
		$data['delete'] = $_POST; 
		if($data['delete']['idPersona'] !== '') {
			$this->loadData($data,$this->debug,$data['delete']['idPersona']);
			if ($this->imgfield != '') {
				$this->deleteImg($data);
			}
			$this->object_model->deleteItem($this->tablename,$data['delete']);
		}
		redirect($this->controller);
	}
	
	//Insertar registro
	public function insertItem($createId = '') {
		$data['insert'] = true;
		$data['update'] = false;
		If($createId === '') {
			$this->loadData($data,$this->debug);
			$_POST = array_merge($_POST,array(
				'idGrupo' => $data['userdata']['idGrupo']
				));
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			
			//$idEvento = $_POST['idEvento'];
			//unset($_POST['idEvento']);
			$data['insert'] = $_POST;
			$data['insert'][$this->pkfield] = $this->object_model->insertItem($this->tablename,$data['insert']);
			if($data['insert'][$this->pkfield] != 0) {
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				if ($this->imgfield != '') {
					$this->loadImg($data,'insert',$this->imgfield);
				}
				redirect($this->controller);
			} else {
				//Establecer mensaje de error en insercción de datos
				$this->loadData($data,$this->debug,$data['insert'][$this->pkfield]);
				$this->loadHTML($data);
				$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}

	//Actualizar registro
	public function updateItem($id = '',$action = false) {
		$data['insert'] = false;
		$data['update'] = true;
		if (!$action) {
			$where = array($this->pkfield => $id);
			$data['info'] = $this->object_model->get($this->tablename,'',$where);
			$_POST = array_merge($_POST,$data['info'][0]);

			$this->loadData($data,$this->debug,$id);
			$this->loadHTML($data);
			$this->load->view('pages/'.$this->pagecard,$data);
		} else {
			$idEvento = $_POST['idEvento'];
			unset($_POST['idEvento']);
			$data['update'] = $_POST;
			$this->loadData($data,$this->debug,$id);
			$where = array($this->pkfield => $id);
			if ($this->object_model->updateItem($this->tablename,$data['update'],$where)) {
				$this->loadImg($data,'update',$this->imgfield);
				redirect($this->controller);
			} else {
				//Establecer mensaje de error en actualizar datos
				$this->loadData($data,$this->debug,$data['update'][$this->pkfield]);
				$this->loadHTML($data);
				$this->load->view('pages/'.$this->pagecard,$data);
			}
		}
	}
	
	public function loadImg(&$data,$action,$fieldName) {
		if ($_FILES['foto']['name'] != '') {
			$img['upload_path']   = 'public/images/'.$this->imgpath.'/';
			$img['allowed_types'] = 'gif|jpg|jpeg|png';
			$img['file_name'] = 'foto'.str_pad($data['records']['0'][$this->pkfield],10,'0', STR_PAD_LEFT);
			if ($data['records']['0']['foto_filename'] != '') {
				if (file_exists($img['upload_path'].$data['records']['0']['foto_filename'])) {
					unlink($img['upload_path'].$data['records']['0']['foto_filename']);
				}
			}
			$this->load->library('upload', $img);
			if ($this->upload->do_upload($fieldName)) {
				$data[$action]['file_info'] = $this->upload->data();
				$filedata = array(
						'foto_filename' => $data[$action]['file_info']['file_name'],
						'foto_filepath' => $data[$action]['file_info']['file_path']
					);
				$where = array($this->pkfield => $data['records']['0'][$this->pkfield]);
				$this->object_model->updateItem($this->tablename,$filedata,$where);
			} else {
				$data[$action]['fail'] = $img;
				//Establecer mensaje de error por la carga del archivo
			}		
		}
	}
		
	public function deleteImg(&$data) {
		//echo "<pre>";print_r($data);echo "</pre>";
		if ($data['records']['0']['foto_filename'] != '') {
			if (file_exists('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename'])) {
				unlink('public/images/'.$this->imgpath.'/'.$data['records']['0']['foto_filename']);
			}
		}
	}
	
	private function loadData(&$data,$debug = false,$id = '') {
		$data['userdata'] = $_SESSION;
		if ($id != '') {
			$data['Persona'] = $this->object_model->get('persona','Nombre', array('idPersona' => $id));
		} else {
			$data['Persona'] = $this->object_model->get('persona','Nombre');
		}
		$data['Genero'] = $this->integrante_model->getGeneroValues();
		$data['DocumentoTipo'] = $this->integrante_model->getDocumentoTipoValues();
		$data['records'] = $data['Persona'];
		$data['morrisjs'] = '';
		if($debug) {
			$print = $data;
		} else {
			$print = '';
		}
		$data['print'] = $print;
	}

	//construir la page completa y permite liberar funcion Index
	private function loadHTML(&$data) {
		switch(true) {
			case $data['insert']:
			case $data['update']:
			$data['page']['buttons'] = $this->load->view('menubuttons/integrante',$data,true);;
				break;
			default:
				$data['page']['buttons'] = $this->load->view('menubuttons/integrantes',$data,true);;
		}
		$data['page']['header']  = $this->load->view('templates/header',$data,true);
		$data['page']['menu']    = $this->load->view('templates/menu',$data,true);
		$data['page']['footer']  = $this->load->view('templates/footer',$data,true);
	}
	
}


?>
