<?php defined('BASEPATH') or exit('No direct script access allowed.');

class Professor extends CI_Controller {
    
        public function __construct() {
            parent::__construct();
			if(!$this->session->userdata('login')){
				$this->load->view('login');
			}
        }

		public function index() {
			$data['url'] = base_url();
			$this->parser->parse('ajaxProf', $data);
			$this->parser->parse('telaProf', $data);
		}
		
		public function index2($id) {
			$data['url'] = base_url();
			$data['idUSUARIO'] = $id;
			$this->parser->parse('ajaxProf', $data);
			$this->parser->parse('telaProf', $data);
		}
				
		
		// Início de chamada de view

		public function v_listar($id) {

			$this->db->select("distinct(MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO), QUESTIONARIO.NOME as 'NOMEQUESTIONARIO'");
			$this->db->from("MUT_has_QUESTIONARIO");
			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
			$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
			$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
			$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
			$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
			$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get()->result();
			
			$this->db->select("distinct(MUT_has_QUESTIONARIO.MATERIA_idMATERIA), MATERIA.NOME as 'NOMEMATERIA'");
			$this->db->from("MUT_has_QUESTIONARIO");
			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
			$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
			$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
			$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
			$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
			$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
			$data['DISCIPLINA'] = $this->db->get()->result();
						
			$this->db->select("distinct(MUT_has_QUESTIONARIO.TURMA_idTURMA), TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE");
			$this->db->from("MUT_has_QUESTIONARIO");
			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
			$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
			$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
			$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
			$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
			$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
			$data['TURMA'] = $this->db->get()->result();
			/*
			$this->db->select("MUT_has_QUESTIONARIO.USUARIO_idUSUARIO as 'idUSUARIO', MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO, QUESTIONARIO.NOME as 'NOMEQUESTIONARIO', MUT_has_QUESTIONARIO.MATERIA_idMATERIA, MATERIA.NOME as 'NOMEMATERIA', MUT_has_QUESTIONARIO.TURMA_idTURMA,
		TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE, QUESTIONARIO.ANO");
			$this->db->from("MUT_has_QUESTIONARIO");
			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
			$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
			$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
			$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
			$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
			$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get()->result();
			
			*/
			$data['url'] = base_url();
			$data['idUSUARIO'] = $id;		
			$this->parser->parse('ajaxProf', $data);
			$this->parser->parse('Professor/listar', $data);
			
			
		}

		public function v_drop($idQ, $idD, $idT, $id) {
			$data['url'] = base_url();	

			if ($idQ == 0 && $idD == 0 && $idT == 0) {
							$this->db->select("MUT_has_QUESTIONARIO.USUARIO_idUSUARIO as 'idUSUARIO', MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO, QUESTIONARIO.NOME as 'NOMEQUESTIONARIO', MUT_has_QUESTIONARIO.MATERIA_idMATERIA, MATERIA.NOME as 'NOMEMATERIA', MUT_has_QUESTIONARIO.TURMA_idTURMA,
		TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE, QUESTIONARIO.ANO");
			$this->db->from("MUT_has_QUESTIONARIO");
			$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
			$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
			$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
			$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
			$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
			$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
			$data['QUESTIONARIO'] = $this->db->get()->result();

			} else		
			if($idQ != 0) {
				$this->db->select("MUT_has_QUESTIONARIO.USUARIO_idUSUARIO as 'idUSUARIO', MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO, QUESTIONARIO.NOME as 'NOMEQUESTIONARIO', MUT_has_QUESTIONARIO.MATERIA_idMATERIA, MATERIA.NOME as 'NOMEMATERIA', MUT_has_QUESTIONARIO.TURMA_idTURMA,
										TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE, QUESTIONARIO.ANO");
				$this->db->from("MUT_has_QUESTIONARIO");
				$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
				$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
				$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
				$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
				$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
				$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
				$this->db->where('MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', $idQ);				
				$data['QUESTIONARIO'] = $this->db->get()->result();
			} else if($idD != 0) {
				$this->db->select("MUT_has_QUESTIONARIO.USUARIO_idUSUARIO as 'idUSUARIO', MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO, QUESTIONARIO.NOME as 'NOMEQUESTIONARIO', MUT_has_QUESTIONARIO.MATERIA_idMATERIA, MATERIA.NOME as 'NOMEMATERIA', MUT_has_QUESTIONARIO.TURMA_idTURMA,
										TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE, QUESTIONARIO.ANO");
				$this->db->from("MUT_has_QUESTIONARIO");
				$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
				$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
				$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
				$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
				$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
				$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
				$this->db->where('MUT_has_QUESTIONARIO.MATERIA_idMATERIA', $idD);				
				$data['QUESTIONARIO'] = $this->db->get()->result();
			} else if($idT != 0) {
				$this->db->select("MUT_has_QUESTIONARIO.USUARIO_idUSUARIO as 'idUSUARIO', MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO, QUESTIONARIO.NOME as 'NOMEQUESTIONARIO', MUT_has_QUESTIONARIO.MATERIA_idMATERIA, MATERIA.NOME as 'NOMEMATERIA', MUT_has_QUESTIONARIO.TURMA_idTURMA,
										TURMA.SERIE, CURSO.NOME as 'NOMECURSO', MODALIDADE.MODALIDADE, QUESTIONARIO.ANO");
				$this->db->from("MUT_has_QUESTIONARIO");
				$this->db->join('QUESTIONARIO', 'QUESTIONARIO.idQUESTIONARIO = MUT_has_QUESTIONARIO.QUESTIONARIO_idQUESTIONARIO', 'inner');
				$this->db->join("MATERIA", "MATERIA.idMATERIA = MUT_has_QUESTIONARIO.MATERIA_idMATERIA", "inner");
				$this->db->join("TURMA", "TURMA.idTURMA = MUT_has_QUESTIONARIO.TURMA_idTURMA", "inner");
				$this->db->join("CURSO", "CURSO.idCURSO = TURMA.idCURSO", "inner");
				$this->db->join("MODALIDADE", "MODALIDADE.idMODALIDADE = CURSO.MODALIDADE", "inner");
				$this->db->where('MUT_has_QUESTIONARIO.USUARIO_idUSUARIO', $id);
				$this->db->where('MUT_has_QUESTIONARIO.TURMA_idTURMA', $idT);				
				$data['QUESTIONARIO'] = $this->db->get()->result();
			
			}
			
			$this->v_listar($id);
			$this->parser->parse('Professor/listarII', $data);
			$this->parser->parse('Professor/fechamento', $data);
		}

		public function v_dimensao($idU, $idT, $idM, $idQ) {
			
			$this->db->select('DIMENSAO.idDIMENSAO, DIMENSAO.DESCRICAO');
			$this->db->from('DIMENSAO');
			$this->db->where('DIMENSAO.idQUESTIONARIO', $idQ);
			$data['DIMENSAO'] = $this->db->get()->result();
			
			$data['idUSUARIO'] = $idU;
			$data['TURMA_idTURMA'] = $idT;
			$data['MATERIA_idMATERIA'] = $idM;
			$data['QUESTIONARIO_idQUESTIONARIO'] = $idQ;
			
			$data['url'] = base_url();
			$this->parser->parse('ajaxProf', $data);
			$this->parser->parse('Professor/dimensao', $data);		
		
		}

		public function v_questionario($idU, $idT, $idM, $idQ, $idD) {
    
			$ano = date("Y");    
    
			$this->db->select("ALUNO.idALUNO, ALUNO.NOME");
			$this->db->from("ALUNO");
			$this->db->join("TURMA_has_ALUNO", "TURMA_has_ALUNO.ALUNO_idALUNO = ALUNO.idALUNO", "inner");
			$this->db->where("TURMA_has_ALUNO.TURMA_idTURMA", $idT);
			$this->db->where("TURMA_has_ALUNO.ANO", $ano);						
			$this->db->order_by("ALUNO.NOME asc");			
			$data['ALUNOS'] = $this->db->get()->result();
			
			$this->db->select("DIMENSAO.DESCRICAO as 'DIMENSAO', DIMENSAO.idDIMENSAO, PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA");
			$this->db->from("DIMENSAO");
			$this->db->join("PERGUNTA", "PERGUNTA.idDIMENSAO = DIMENSAO.idDIMENSAO", "inner");
			$this->db->where("DIMENSAO.idQUESTIONARIO", $idQ);
			$this->db->where("PERGUNTA.TIPO", 0);
			$this->db->where("DIMENSAO.idDIMENSAO", $idD);
			$data['PERGUNTA_FECHADA'] = $this->db->get()->result();
			
			$this->db->select("DIMENSAO.DESCRICAO as 'DIMENSAO', DIMENSAO.idDIMENSAO, PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA");
			$this->db->from("DIMENSAO");
			$this->db->join("PERGUNTA", "PERGUNTA.idDIMENSAO = DIMENSAO.idDIMENSAO", "inner");
			$this->db->where("DIMENSAO.idQUESTIONARIO", $idQ);
			$this->db->where("PERGUNTA.TIPO", 1);
			$this->db->where("DIMENSAO.idDIMENSAO", $idD);
			$data['PERGUNTA_ABERTA'] = $this->db->get()->result();
			
			$data['idUSUARIO'] = $idU;
			$data['idTURMA'] = $idT;
			$data['idMATERIA'] = $idM;
			$data['idQUESTIONARIO'] = $idQ;			
			
			$data['url'] = base_url();

			$this->parser->parse('ajaxProf', $data);
			$this->parser->parse('Professor/questionario', $data);			
										
		}

		// Fim de chamada de view

		public function checkbox($item, $id) {

			$data['idUSUARIO'] = $id;
			
			for ($i = 0; $i < count($item); $i++) {
				$valor = $item[$i];					
				$resposta = explode(";", $item[$i]);
				$data['idALUNO'] = $resposta[0];
				$data['idPERGUNTA'] = $resposta[1];
				$data['RESPOSTA'] = $resposta[2];
				
				$this->db->insert('RESPOSTA', $data);
			}
		
				
		}
		

		public function resposta() {
			
			$alunovetor = $this->input->post('idTURMA_ALUNO');	
			$idT = $this->input->post('idTURMA');
			$idM = $this->input->post('idMATERIA');
			$idQ = $this->input->post('idQUESTIONARIO');
			$id = $this->input->post('idUSUARIO');
			for ($i = 0; $i < count($alunovetor); $i++) {
				$item = $this->input->get_post($alunovetor[$i]);
				$this->checkbox($item, $id);
			}
			
			$idPERGUNTA = $this->input->post('idPERGUNTA');
			$txt_respostaaberta = $this->input->post('txt_respostaaberta');			
			$data['idUSUARIO'] = $id;
			
			for ($i = 0; $i < count($idPERGUNTA); $i++) {
				$data['idPERGUNTA'] = $idPERGUNTA[$i];
				$data['RESPOSTA_ABERTA'] = $txt_respostaaberta[$i];
				$data['idALUNO'] = $alunovetor[0];
				
				$this->db->insert('RESPOSTA', $data);				
				
			}

			echo '<script>confirm("Questionário respondido com sucesso!")</script>';
			
			unset($data);
			$this->v_dimensao($id, $idT, $idM, $idQ);			
			
		}

}
