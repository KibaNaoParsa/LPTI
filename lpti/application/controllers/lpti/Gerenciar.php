<?php defined('BASEPATH') or exit('No direct script acess allowed');
      class Gerenciar extends CI_Controller {

            public function index() {
               $data['url'] = base_url();
               $this->parser->parse('tela_principal', $data);
            }
            
            public function call_tela_cadastro() {
               $data['url'] = base_url();
               $this->parser->parse('tela_cadastro_usuario', $data);
            }

            public function call_listar_cadastro() {
               $data['usuario'] = $this->db->get('Usuario')->result();

               $data['url'] = base_url();
               $this->parser->parse('tela_listar_usuario', $data);
            }

            public function call_editar_cadastro($Codigo) {
	       		$data['usuario'] = $this->db->get('Usuario')->result();

      			$this->load->helper('form');
		       	$this->parser->parse('tela_editar_usuario', $data);

            }

            public function call_tela_turma() {
               $data['url'] = base_url();
               $this->parser->parse('tela_cadastro_turma', $data);
            }


       		public function adicionar(){
         		$data['nome'] = $this->input->post('txt_nome');
                $data['login'] = $this->input->post('txt_login');
		     	$data['senha'] = $this->input->post('txt_senha');


			    if($this->db->insert('Usuario', $data)){
					redirect(base_url('gerenciar'));
		      	} else {
		            echo "Inclusão impossibilitada";
			    }
		     }
		     
     		public function salvar_alteracao(){
       			$data['Nome'] = $this->input->post('txt_nome');
	      		$data['Login'] = $this->input->post('txt_login');
		    	$data['Senha'] = $this->input->post('txt_senha');
		     	$data['Tipo'] = $this->input->post('txt_atividade');

			    $confirm = true;

       			$active = (int) $this->input->post('txt_atividade');

       			if (($active != 0) || ($active != 1))
	      			$confirm = false;

       			if (!$confirm) {

	        		$this->db->where('Codigo', $this->input->post('Codigo'));

       			    if($this->db->update('Usuario', $data))
		        		redirect(base_url('gerenciar'));

                } else {
		       		echo "Alteração impossibilitada";
			    }
			        
       		}


      }

/*

	class Gerenciar extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			if(!$this->session->userdata('logado')){
				redirect("administracao/login");
			}
		}
		
		public function index() {
			$this->load->view('administracao/tela_principal');
		}
		
		public function control_professor() {
			$this->load->helper('form');
			$this->load->view('administracao/control_professor');	
		}
		
		public function call_adicionar_professor() {
			$this->load->helper('form');
			$this->load->view('administracao/area_dos_professores/cadastrar_professor');	
		}
		
		public function adicionar(){
			$data['nome'] = $this->input->post('txt_nome');
			$data['login'] = $this->input->post('txt_login');
			$data['senha'] = $this->input->post('txt_senha');
			
		
			if($this->db->insert('Usuario', $data)){
					redirect(base_url('administracao/gerenciar'));
			} else {
				echo "Inclusão impossibilitada";
			}
		}
		
		public function adicionar_aluno(){
			$data['codigoturma'] = $this->input->post($turma[0]->CodigoTurma);
			$data['nome'] = $this->input->post('txt_nome');
			$data['matricula'] = $this->input->post('txt_matricula');
			
		
			if($this->db->insert('Usuario', $data)){
					redirect(base_url('administracao/gerenciar'));
			} else {
				echo "Inclusão impossibilitada";
			}
		}
		
		public function call_control_turmas() {
			$data['turma'] = $this->db->get('Turma')->result();
			
			$this->load->helper('form');
			$this->load->view('administracao/control_turmas', $data);	
		}
		
		public function call_selecao() {
			$this->load->helper('form');
			$this->load->view('administracao/area_das_turmas/selecao');
		}
		
		public function call_adicionar_aluno() {
			//$data['turma'] = $this->db->get('Turma')->result();
			$this->load->helper('form');
			$this->load->view('administracao/area_das_turmas/adicionar_aluno');
		}
		
		public function call_editar_professor() {
			$data['usuario'] = $this->db->get('Usuario')->result();
		
			$this->load->helper('form');
			$this->load->view('administracao/area_dos_professores/listar_professor', $data);	
		}
		
		
		public function editar_professor($Codigo) {
			$this->db->where('Codigo', $Codigo);
			$data['usuario'] = $this->db->get('Usuario')->result();
			$this->load->helper('form');
			$this->load->view('administracao/area_dos_professores/editar_professor', $data);
		}

		public function salvar_alteracao(){
			$data['Nome'] = $this->input->post('txt_nome');
			$data['Login'] = $this->input->post('txt_login');
			$data['Senha'] = $this->input->post('txt_senha');
			$data['Tipo'] = $this->input->post('txt_atividade');
			
			$confirm = true;
			
			$active = (int) $this->input->post('txt_atividade');
			
			if (($active != 0) || ($active != 1)) 
				$confirm = false;
			
			if (!$confirm) {
			
			$this->db->where('Codigo', $this->input->post('Codigo'));
			
			if($this->db->update('Usuario', $data))
				redirect(base_url('administracao/gerenciar'));
			}else{
				echo "Alteração impossibilitada";
			}
		}
		
		
		/*
		public function index(){
			$data['banda'] = $this->db->get('banda')->result();
			$this->load->helper('form');
			$this->load->view('administracao/nova_postagem',$data);
		}
		
		public function call_adicionar() {
			$this->load->helper('form');
			$this->load->view('administracao/cadastrar_banda');
		}
		
		public function adicionar(){
			$data['nome'] = $this->input->post('txt_titulo');
			$data['qtd_integrantes'] = $this->input->post('txt_texto');
			$dia = (int) $this->input->post('txt_dia');
			$mes = (int) $this->input->post('txt_mes');
			$ano = (int) $this->input->post('txt_ano');
			
			$confirm = true;
			
			if ((!is_numeric($dia)) || (!is_numeric($mes)) || (!is_numeric($ano)) ) {
				$confirm = false;
			}
			
			if (($dia < 1) || ($dia > 31) || ($mes < 1) || ($mes > 12) || ($ano > 2017) ) {
				$confirm = false;
			}
			
			if ((($mes == 4) || ($mes == 6) || ($mes == 9) || ($mes == 11)) && ((int)$dia > 30)) {
				$confirm = false;
			}

			if (($mes == 2) && ($dia > 28)) {
				$confirm = false;
			}

			if ($confirm == true) {
				$data['data_fundacao'] = $ano."-".$mes."-".$dia;
				if($this->db->insert('banda', $data)){
					redirect(base_url('administracao/gerenciar'));
				}
			} else {
				echo "Inclusão impossibilitada";
			}
		}
		
		public function alterar($id){
			$this->db->where('id', $id);
			$data['banda'] = $this->db->get('banda')->result();
			$this->load->helper('form');
			$this->load->view('administracao/alterar_postagem', $data);
		}
		public function salvar_alteracao(){
			$data['nome'] = $this->input->post('txt_titulo');
			$data['qtd_integrantes'] = $this->input->post('txt_texto');
			$data['data_fundacao'] = $this->input->post('txt_data');
			$this->db->where('id', $this->input->post('id'));
			
			if($this->db->update('banda', $data)){
				redirect(base_url('administracao/gerenciar'));
			}else{
				echo "Alteração impossibilitada";
			}
		}
		public function excluir($id){
			$this->db->where('id', $id);
			if($this->db->delete('banda')){
				redirect(base_url('administracao/gerenciar'));
			}else{
				echo "Exclusão impossibilitada";
			}
		}
		
		public function gerarpdf() {
			$data['banda'] = $this->db->get('banda')->result();
			$this->load->helper('form');
			$this->load->view('administracao/pdf', $data);
		}
		*/

