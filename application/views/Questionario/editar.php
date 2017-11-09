          <div id="page-wrapper">
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Edição de Questionários</h1>
                  </div>
                  <!-- /.col-lg-12 -->
              </div>
              <!-- /.row -->
              <div class="row">
                        <div class="col-lg-6 col-md-4">
                            <?php

                                //  Formulário para edição de nome

                        $atributos = array('name'=>'formulario_cadastro', 'id'=>'formulario_cadastro');
                                $btn = array('name'=>'btn_cadastrar', 'id'=>'botao1', 'class'=>'btn btn-warning');
                                echo form_open('Questionario/editarNome', $atributos).
                                     form_hidden('id', $QUESTIONARIO[0]->idQUESTIONARIO).
                                     form_label("Nome: ", "txt_nome")." ".
                                     form_input('txt_nome', $QUESTIONARIO[0]->NOME).br().

                                     form_submit("btn_cadastrar", " Salvar Alterações ", $btn).br().
                                     form_close().br();

                                // Formulário para cadastro de dimensão

                                echo form_open('Questionario/dimensao', $atributos).
                                     form_hidden('id', $QUESTIONARIO[0]->idQUESTIONARIO).
                                     "<h5><b>Questionário: ".
                                     $QUESTIONARIO[0]->NOME.
                                     "</b></h5>".
                                     form_label("Dimensão: ", "txt_dimensao").
                                     form_input('txt_dimensao') .br().
                                     form_submit("btn_cadastrar", " Criar ", $btn).br().
                                     form_close().br();

                                // Tabela de dimensões

                                echo "<table style='width: 100%'>
                                        <tr>
                                            <th>Dimensão</th>
                                            <th></th>
                                        </tr>";

                                        foreach($DIMENSAO as $d) {
                                            echo "<tr><td>".$d->DESCRICAO."</td>
                                            <td>".anchor("Questionario/excluir_dimensao/".$d->idDIMENSAO,
                                            " Excluir ", 'class= "btn btn-danger"')."</td></tr>";
                                        }

                                        echo "</tr>";
                                echo "</table>";

                                echo br().br();

                                // Formulário para cadastro de perguntas

                                echo "<button type='button' id='btn1' name='button'>Ver perguntas</button> " .
                                        "<button type='button' id='btn2' name='button'>Esconder perguntas</button>".br();

                                echo "<div class='texto'>";

                                $perdi = $this->db->query("select PERGUNTA.idPERGUNTA, PERGUNTA.PERGUNTA, DIMENSAO.DESCRICAO, PERGUNTA.TIPO FROM PERGUNTA INNER JOIN DIMENSAO ON
                                                    PERGUNTA.idDIMENSAO = DIMENSAO.idDIMENSAO
                                                    WHERE DIMENSAO.idQUESTIONARIO = " . $QUESTIONARIO[0]->idQUESTIONARIO)->result();

                                foreach ($perdi as $p) {
                                		if ($p->TIPO == 0) {
													$text = 'Pergunta fechada';                                		
                                		} else {
													$text = 'Pergunta aberta';                                		
                                		}
                                    echo anchor("Questionario/excluirPergunta/".$p->idPERGUNTA,
                                                " Excluir ", 'class= "btn btn-danger"');
                                    echo $p->PERGUNTA." - ".$p->DESCRICAO." - ".$text.br();
                                }

                                echo "</div>".br();




                                echo form_open('Questionario/inserirPergunta', $atributos).
                                form_hidden('id', $QUESTIONARIO[0]->idQUESTIONARIO).
                                    form_label("Pergunta: ", "txt_pergunta")." ".
                                    form_textarea('txt_pergunta').br().
                                    br().
                                    "<b><i>Selecione o tipo de pergunta: </i></b>".br().br().

                                    form_radio("tipo[]", 0, FALSE).
                                    form_label("Pergunta fechada ", "txt_li").br().

                                    form_radio("tipo[]", 1, FALSE).
                                    form_label("Pergunta aberta ", "txt_li").br().br().

                                    "<b><i>Selecione a dimensão: </i></b>".br().br();


                                    foreach($DIMENSAO as $d) {
                                        echo form_radio("dimensao[]", $d->idDIMENSAO, FALSE).
                                            form_label($d->DESCRICAO, "txt_li2").br();
                                    }


                                    echo br().form_submit("btn_cadastrar", " Cadastrar ", 'class = "btn btn-primary"').br().
                                    form_close();


                                // Chamada de próxima tela
                                echo br().br();
                                echo anchor('Questionario/v_associar/'.$QUESTIONARIO[0]->idQUESTIONARIO, " Continuar ",'class="btn btn-success btn-lg"');


                            ?>
                                            </div>
              </div>
          </div>
        </div>
      </div>


    <style>

        table, th, td {
            border: 1px solid black;
            text-align: center;
        }

    </style>



    <!-- jQuery -->
    <script src="{url}assets/js/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(e){
        $("#btn a").click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $("#Main").load(href + " #Main");
        });
      });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".texto").hide();
        });

        $(document).click(function(){
            $("#btn1").click(function(){
                $(".texto").fadeIn();
            });
            $("#btn2").click(function(){
                $(".texto").fadeOut();
            });
        });
    </script>


    <!-- Bootstrap Core JavaScript -->
    <script src="{url}assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{url}assets/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{url}assets/js/raphael.min.js"></script>
    <script src="{url}assets/js/morris.min.js"></script>
    <script src="{url}assets/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{url}assets/js/sb-admin-2.js"></script>

</body>

</html>

