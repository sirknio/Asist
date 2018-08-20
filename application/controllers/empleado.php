<?php if (!defined('BASEPATH')) exit('No direct access allowed');

class Empleado extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usuario')) {
			redirect('login');
		}
		$this->load->model('object_model');
		$this->load->model('empleado_model');
    }
    
    public function index() {
        
    }
	
}

?>
