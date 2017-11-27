<?php defined('BASEPATH') or exit('No direct script access allowed');

class Importacao extends CI_Controller {

	public function readmeTurma() {
		
		$dicas = "Instruções para utilizar o sistema de importação
		1- Baixar o arquivo '.xls'(use o botão ao lado)
		2- Abir o arquivo '.xls', que por padrão terá o nome 'Tabela_Turmas'(no destino de download escolhido, geralmente na pasta 'Downloads')
		3- Copiar(ctrl+c) os dados de matrícula e colar(ctrl+v) no seu respectivo local(1ª coluna do arquivo '.xls')
		4- Copiar(ctrl+c) os dados de nome e colar (ctrl+v) no seu respectivo local(3ª coluna do arquivo '.xls')
		5- Copiar(ctrl+c) as 4 primeiras colunas do arquivo '.xls'
		6- Colar(ctrl+v) os dados copiados na caixa de texto abaixo
		7- Marcar qual a turma a ser inserida no sistema
		8- Clicar no botão de cadastro(Cadastrar)";		
		
 		header("Content-type: application/text");   
   	header("Content-Disposition: attachment; filename=READ-ME_Turmas.txt");   
		echo $dicas;
	}
	
	public function readmeNotas() {
		
		$dicas = "Instruções para utilizar o sistema de importação
		1- Baixar o arquivo '.xls'(use o botão ao lado)
		2- Abir o arquivo '.xls', que por padrão terá o nome 'Tabela_Notas'(no destino de download escolhido, geralmente na pasta 'Downloads')
		3- Copiar(ctrl+c) os dados de nota e colar(ctrl+v) no seu respectivo local(1ª coluna do arquivo '.xls')
		4- Esses dados deverão entrar em ordem alfabética de nome(Por exemplo, a nota do aluno André deverá ser colocado antes da nota da aluna Bruna)
		5- Copiar(ctrl+c) as 2 primeiras colunas do arquivo '.xls'
		6- Colar(ctrl+v) os dados copiados na caixa de texto abaixo
		7- Marcar qual o bimestre que a nota se refere
		8- Clicar no botão de cadastro(Cadastrar)";		
		
 		header("Content-type: application/text");   
   	header("Content-Disposition: attachment; filename=READ-ME_Notas.txt");   
		echo $dicas;
	}
	
	public function readmeFrequencias() {
		
		$dicas = "Instruções para utilizar o sistema de importação
		1- Baixar o arquivo '.xls'(use o botão ao lado)
		2- Abir o arquivo '.xls', que por padrão terá o nome 'Tabela_Notas'(no destino de download escolhido, geralmente na pasta 'Downloads')
		3- Copiar(ctrl+c) os dados de frequência e colar(ctrl+v) no seu respectivo local(1ª coluna do arquivo '.xls')
		4- Esses dados deverão entrar em ordem alfabética de nome(Por exemplo, a frequência do aluno André deverá ser colocado antes da frequência da aluna Bruna)
		5- Copiar(ctrl+c) as 2 primeiras colunas do arquivo '.xls'
		6- Colar(ctrl+v) os dados copiados na caixa de texto abaixo
		7- Marcar qual o bimestre que a frequência se refere
		8- Clicar no botão de cadastro(Cadastrar)";		
		
 		header("Content-type: application/text");   
   	header("Content-Disposition: attachment; filename=READ-ME_Frequencias.txt");   
		echo $dicas;
	}
	
	public function excel() {
		$html = "<table>
					<tr>
        				<td><b>Matricula</b></td>        
        				<td></td>        
						<td><b>Nome</b></td>
						<td></td>     
    			    </tr>					 
					 <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			    <tr>
        				<td></td>        
        				<td>:</td>        
						<td></td>
						<td>;</td>       
    			    </tr>
    			 </table>";

		// Configurações header para forçar o download
		header ('Content-type: application/x-msexcel');
		header ('Content-Disposition: attachment; filename="Tabela_Turmas.xls"' );

		echo $html;	
	}
	
	public function excel2() {
		$html = "<table>
					<tr>
        				<td><b>Nota</b></td>        
        				<td></td>        
    			    </tr>					 
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>					 
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			 </table>";

		// Configurações header para forçar o download
		header ('Content-type: application/x-msexcel');
		header ('Content-Disposition: attachment; filename="Tabela_Notas.xls"' );

		echo $html;	
	}
	
	public function excel3() {
		$html = "<table>
					<tr>
        				<td><b>Frequencia</b></td>        
        				<td></td>        
    			    </tr>					 
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>					 
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
					 <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			     <tr>
        				<td></td>        
        				<td>:</td>              
    			    </tr>
    			 </table>";

		// Configurações header para forçar o download
		header ('Content-type: application/x-msexcel');
		header ('Content-Disposition: attachment; filename="Tabela_Frequencias.xls"' );

		echo $html;	
	}
}
