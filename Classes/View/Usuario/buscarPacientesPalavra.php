<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>
<?php
$idHomePage = trim(filter_input(INPUT_GET, 'idHomePage', FILTER_SANITIZE_NUMBER_INT));

if (isset($_SESSION['usuarioNome'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Bootstrap Agency Page Template</title>
            <!-- Bootstrap -->
            <link href="../../../../css/bootstrap-4.0.0.css" rel="stylesheet">
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <img class="rounded-circle" src="../../../images/logotipoMedBook.jpg" width="45" height="45" title="Logo tipo" />
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"> <a class="nav-link" href='home.php?idUsuario=<?php echo $_SESSION['usuarioId'];?>''>Home <span class="sr-only">(current)</span></a> </li>
                        <!--
                        <li class="nav-item"> <a class="nav-link" href="#">Link</a> </li>
                        -->
                        <!--
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a> 
                            </div>
                        </li>
                        -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Encontrar usuários </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="buscarPacientes.php">Paciêntes</a>
                                <a class="dropdown-item" href="buscarMedicos.php">Médicos</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
    if (isset($_SESSION['usuarioNome']) && $_SESSION['usuarioNome'] != null) {
        ?>
                                    <img class="rounded-circle" src='<?php echo "../../../imagens/" . $_SESSION['usuarioImagem']; ?>' alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
        <?php
        $conexao = new Conexao();
        $dalUsuario = new DALUsuario($conexao);
        echo($dalUsuario->primeiroNome($_SESSION['usuarioNome']));
        ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <table>
                                        <tr>
                                            <td><a class="dropdown-item" href='../Alterar/AlterarUsuario.php?idPessoa=<?php echo $_SESSION['usuarioId']; ?>'><img title="alterar informações do usuario" class="rounded-circle" src="../../../images/124654893.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Alterar informações</a>
                                                <div class="dropdown-divider">
                                            </td>
                                        </tr>
                                        <tr align="center">
                                            <td align="center">
                                                <a href="../../Conexao/sair.php">
                                                    <input align="right" class="btn btn-danger" type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sair&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" name="enviarLogof" /></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </li>
        <?php
    } else {
        ?> <!--  INICIO DO MENU DROP COM USUARIO DESLOGADO -->
                            <img class="rounded-circle" src="../../../imagens/profile.png" alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
        <?php echo("Usuário"); ?>
    <?php } ?>
                        </a>
                        <div align="center" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <form name="formLogin" action="#" target="_self" method="post">
                                <table align="center">
                                    <tr>
                                    <div class='border-0'><td><img title="nome de usuário" class="rounded-circle" src="../../../images/user-silhouette.png" width="35" height="37" /></td><td>&nbsp;<input class="alert border-0 text-center " name="email" type="email" required="required" id="celular" placeholder="Informe o seu email (Obrigatório)" title="email" size="30" maxlength=50"></div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <div class='border-0'><td><img title="senha" class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></td><td>&nbsp;<input name="senha" type="password" class="alert border-0 text-center" required="required" id="endereco" placeholder="Informe a senha (Obrigatório)" title="Senha" size="30" maxlength=50"></div>
                                    </td>
                                    </tr>
                                </table>
                                <table align="center">
                                    <hr>
                                    <td align="center"></td><td align="center">
                                        <input align="center" class="btn btn-primary" type="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" name="enviarLogin" />
                                    </td>
                                    <tr>
                                        <td align="center"></td>
                                        <td align="center"><br><a class="dropdown-item" href="CadastroSimplesUsuario.php">Cadastrar-se</a>
                                        </td>
                                    </tr>

                                </table>
                            </form>
                            </li>
                    </ul>

                    <!-- PROCURAR VERDE -->
                    <form name="formBuscar" class="form-inline my-2 my-lg-0" action="buscarUsuarios.php" target="_self" method="post">
                        <div class="btn border-0"><input required="" name="buscar" class='btn btn border-0 text-center font-weight-bold' size="19" type="search" aria-label="Search"><!--<input name="procurar" class='align-baseline' type="image" id="procurar" title="Procurar" src="images/musica-searcher.png" alt="procurar" width="25" height="28" />-->
                            <button class='btn border-0 text-center font-weight-bold' >
                                <img src="../../../images/musica-searcher.png" width="25" height="28" /></button>
                        </div>
                    </form>
                </div>
            </nav>
            <section>
                <!-- FIM GALERIA DE AMIGOS -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-20 mx-auto">
                            <div class="jumbotron">
                                <div class="container" align="center">
		  <table class="table table-striped" align="center">
			<tr>
				<td align="center">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;Nome:&nbsp;&nbsp;&nbsp;&nbsp;</h5>
				</td>
				<td align="center">
					<h5>&nbsp;&nbsp;&nbsp;&nbsp;Tipo usuário:&nbsp;&nbsp;&nbsp;&nbsp;</h5>
				</td>
				<td align="center">
					<h5>Imagem do perfil:</h5>
				</td>
			</tr>
		<?php
			  $palavra = $_POST['buscar'];
			  $resultado = $dalUsuario->localizarPacientePalavra($palavra);
			  if(is_null($resultado) && $resultado == null)
			  {
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/index.php'>
				<script type= \"text/javascript\">
				alert(\"Erro ao efetuar a busca na base de dados, A palavra não existe\");
				</script>";
				exit();
			  }
		
		while($dados = mysqli_fetch_array($resultado))
		{ ?>
			<tr>
			  <td align="center">
				  <a class="dropdown-item" href='home.php?idUsuario=<?php echo $dados['idUsuario'];?>'>
				  	<?php echo $dados['nome']; ?>
				  </a>
			  </td>
			  <td align="center">
				  <a class="dropdown-item" href='home.php?idUsuario=<?php echo $dados['idUsuario'];?>'>
				  	<?php echo $dados['nivelAcesso']; ?>
				  </a>
			  </td>
			  <td align="center">
				  <a class="dropdown-item" href='home.php?idUsuario=<?php echo $dados['idUsuario'];?>'><img class="rounded-circle" width="70" height="70" src='../../../imagens/<?php echo $dados['imagem'];?>'/>
				  </a>
			  </td>
			</tr>

		  <?php } ?>
		  </table>
		</div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- FIM GALERIA DE AMIGOS -->
                    <!-- FOOTER -->
                    <footer class="text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <p>Copyright © Medbook. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- FIM FOOTER -->
                    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
                    <script src="../../../../js/jquery-3.2.1.min.js"></script> 
                    <!-- Include all compiled plugins (below), or include individual files as needed --> 
                    <script src="../../../../js/popper.min.js"></script> 
                    <script src="../../../../js/bootstrap-4.0.0.js"></script>
                    </body>
                    </html>
                    <?php
                } else {
                    echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=../../../index.php'>
    <script type= \"text/javascript\">
    alert(\"você não tem autorização para acessar a esta página.\");
    </script>";
                }
?>