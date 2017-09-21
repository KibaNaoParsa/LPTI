<!DOCTYPE html>
<html lang="en">

<head>

    <title>Inicio</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="elyas" >

    <title>Início</title>
    <link href="{url}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{url}assets/css/metisMenu.min.css" rel="stylesheet">
    <link href="{url}assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="{url}assets/css/morris.css" rel="stylesheet">
    <link href="{url}assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="{url}assets/css/estilo.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-brand" href="{url}login/loginAsEst">Conselho de Classe</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{url}Login/efetuar_logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse" id="btn">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../Login/telaInicial">Início</a>
                        </li>
                        <li>
                            <a href="../Listar/listar/0/0">Lista de Alunos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
									<a href="#">Integrado<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="#">Turmas <span class="fa arrow"></span></a>
											<ul class="nav nav-fourth-level">
												<li>
													<a href="#">Edificações <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
														<li>
															<a href="#">3° Ano</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="#">Informática <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
														<li>
															<a href="#">3° Ano</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="#">Mecatrônica <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
														<li>
															<a href="#">3° Ano</a>
														</li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
                                </li>
                                <li>
									<a href="#">Subsequente<span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="#">Turmas <span class="fa arrow"></span></a>
											<ul class="nav nav-fourth-level">
												<li>
													<a href="#">Edificações <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="#">Informática <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="#">Mecatrônica <span class="fa arrow"></span></a>
													<ul class="nav nav-fifth-level">
														<li>
															<a href="#">1° Ano</a>
														</li>
														<li>
															<a href="#">2° Ano</a>
														</li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
                                </li>
                                <li>
                                    <a href="buttons.html">Todos Alunos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="../Cadastro/cadastrar">Cadastrar usuários</a>
                        </li>
                        <li>
                            <a href="../Cadastro/editar">Editar usuários</a>
                        </li>
                        <li>
                            <a href="../Permissao/v_tela_listagem">Ajustar permissões de usuário</a>
                        </li>
								<li>
                            <a href="#">Questionários<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../Questionario/v_cadastro">Criar questionário</a>
                                </li>
                                <li>
                                    <a href="../Questionario/v_listar">Editar questionários</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
								<li>
                            <a href="#">Turmas e Disciplinas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../Materia/v_cadastrar_materias">Cadastrar disciplinas </a>
                                </li>
                                <li>
                                    <a href="../Materia/v_listar_materias">Listar disciplinas</a>
                                </li>
                                <li>
                                    <a href="../Materia/v_associar_materias">Associar disciplinas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <!--
                        <li>
                            <a href="../Cadastro/addCurso">Cadastrar Curso</a>
                        </li>
                        <li>
                            <a href="../Cadastro/editCurso">Editar Curso</a>
                        </li>
                        -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>