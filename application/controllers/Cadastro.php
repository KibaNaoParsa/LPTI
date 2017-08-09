<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Cadastro extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
		}

		public function cadastrar(){
			$data['url'] = base_url();
			$this->parser->parse('cadastro', $data);
		}

		public function cadastro(){
			$data['LOGIN'] = $this->input->post('txt_login');
			$data['SENHA'] = $this->input->post('txt_senha');
			$data['TIPO'] = $this->input->post('txt_tipo');
			$senha = $this->input->post('txt_confirmarsenha');
			if(!$this->db->where('LOGIN', $data['LOGIN'])){
			 $data['modal'] = "$(window).on('load',function(){
							  $('#erro-modal').modal('show');
							  });";
			 $data['url'] = base_url();
			 $this->parser->parse('cadastro', $data);
			}
			else
				$this->confere($data, $senha);
		}

		public function editar(){
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			$data['url'] = base_url();
			$this->parser->parse('editar', $data);
		}

		public function editor($id){
			$this->db->where('idUSUARIO', $id);
			$data['USUARIO'] = $this->db->get('USUARIO')->result();
			$data['url'] = base_url();
			$this->parser->parse('editor', $data);
		}

		//Apresenta Problemas (Falar com professores)

		public function edit(){
			$data['LOGIN'] = $this->input->post('txt_login');
			$data['SENHA'] = $this->input->post('txt_senha');
			$data['TIPO'] = $this->input->post('txt_tipo');
			$data['idUSUARIO'] = $this->input->post('id');
			$senha = $this->input->post('txt_confirmarsenha');
			if($this->db->where('LOGIN', $data['LOGIN'])){
				$ctr = $this->db->where('LOGIN', $data['LOGIN']);
				if($ctr['idUSUARIO'] != $data['idUSUARIO']){
				 $data['modal'] = "$(window).on('load',function(){
								  $('#erro-modal').modal('show');
								  });";
				 $data['url'] = base_url();
				 $this->parser->parse('cadastro', $data);
		 		}
				else
					$this->confere($data, $senha);
			}
			else
				$this->confere($data, $senha);
		}

		public function excluir($id){
			$this->db->where('idUSUARIO', $id);
			if($this->db->delete('USUARIO')){
				redirect('Login/loginAsAdm');
			}
		}

	public function confere($data, $senha){
		if($data['SENHA'] == $senha){
			$data['SENHA'] = sha1($data['SENHA']);
			$this->db->update('USUARIO', $data);
			$data['url'] = base_url();
			$this->parser->parse('telaAdm', $data);
		}
		else{
			$data['modal'] = "$(window).on('load',function(){
							$('#erro-modal').modal('show');
							});";
		$data['url'] = base_url();
		 $this->parser->parse('cadastro', $data);
		}
	}
}
