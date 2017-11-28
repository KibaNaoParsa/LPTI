<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="alunos" >

    <title>Conselho de Classe</title>

    <!-- Bootstrap Core CSS -->
    <link href="{url}assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{url}assets/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{url}assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>Conselho de Classe</h1>
            <h3>Sistema de conselho de classe CEFET-MG Varginha</h3>
            <br>
            <button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#login-modal">Entrar</button>
            <div class="modal fade" id="login-modal">
					<div class="modal-dialog">
						<div class="loginmodal-container">
							<h1>Entrar</h1><br>
							<?php
								$atributos = array('name'=>'formulario_login', 'id'=>'formulario_login');
								echo form_open('login/efetuar_login', $atributos).
								form_label("Nome: ", "txt_nome").br().
								form_input('txt_nome').br().
								form_label("Senha: ", "txt_senha").br().
								form_password('txt_senha').br().
								form_submit("btn_enviar", "Entrar", "login loginmodal-submit").form_close();
							?>
							{msg}
						</div>
					</div>
				</div>
        </div>
    </header>




    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Conselho de Classe</strong>
                    </h4>
                    <p>CEFET-MG Varginha</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (35) 3690-4200</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/cefetmgvarginha/?hc_ref=SEARCH"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/cefet_mg"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="http://www.varginha.cefetmg.br/"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <?php echo '<p class="text-muted">Copyright &copy; CristhSoft '.date("Y").' </p>';
                      ?>
                </div>
            </div>
        </div>
        <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
    </footer>

    <!-- jQuery -->
    <script src="{url}assets/js/jquery.js"></script>

        <script src="{url}assets/DataTables/media/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
      $(document).ready(function(e){
        $("#btn a").click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $("#Main").load(href + " #Main", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
            $('#myTable').DataTable({
                "bRetrieve": true,
                "bPaginate": true,
                "bJQueryUI": false,
                "sPaginationType": "full_numbers",
                "oLanguage": {
                    "sUrl": "{url}assets/language/ptbr.txt"
                }
            });
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
    });
        });
      });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{url}assets/js/bootstrap.min.js"></script>


    <!-- Metis Menu Plugin JavaScript -->
    <script src="{url}assets/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript
    <script src="{url}assets/js/raphael.min.js"></script>
    <script src="{url}assets/js/morris.min.js"></script>
    <script src="{url}assets/js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->

    <script>
        {modal}
    </script>
    <script src="{url}assets/js/sb-admin-2.js"></script>

</body>

</html>


