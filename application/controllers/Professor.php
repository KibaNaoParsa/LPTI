<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Professor extends CI_Controller {
    
        public function __construct() {
            parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
//				$this->load->view('login');
			}
        }

		public function index() {
			$data['url'] = base_url();
			$this->parser->parse('telaProf', $data);
		}
		
		// Início de chamada de view

		public function v_listar($id) {
			$data['url'] = base_url();
			$data['idUSUARIO'] = $id;
			
			$this->parser->parse('listar', $data);
			
		}


		// Fim de chamada de view


}
