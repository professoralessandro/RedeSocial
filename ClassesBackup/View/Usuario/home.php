<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>
<?php

if(isset($_SESSION['usuarioNome']))
{
	if(isset($_POST['email']) && isset($_POST['senha']))
	{
		$conexao = new Conexao();

		$dalUsuario = new DALUsuario($conexao);

		$email = trim($_POST['email']); //Escapar de injeção sql

		$senha = trim($_POST['senha']);

		$validacao = new Validacao();

		//echo($email." ".$senha);

		$result = $dalUsuario->altenticarUsuario($email, $senha);

		//print_r($result);

		$resultado = mysqli_fetch_assoc($result);

		//print_r($resultado);

		if(empty($resultado))
		{
			echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
			<script type= \"text/javascript\">
			alert(\"Erro ao logar. Por favor verifique login e senha, tente novamente.\");
			</script>";
		}
		elseif(isset($resultado))
		{
			$usuario = new Usuario($resultado['idUsuario'], $resultado['nome'], $resultado['dataNascimento'], $resultado['dataCadastro'], $resultado['email'], $resultado['senha'], $resultado['nivelAcesso'], $resultado['ddd'], $resultado['telefone'], $resultado['sexo'], $resultado['imagem']);

			$login = $validacao->logar($usuario);
			if(!$login)
			{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
				<script type= \"text/javascript\">
				alert(\"seja bem vindo {$resultado['nome']} .\");
				</script>";
			}
			else
			{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
				<script type= \"text/javascript\">
				alert(\"Erro ao logar. Por favor verifique login e senha, tente novamente 2.\");
				</script>";
			}
		}
		else if(isset($_POST['deslogar']))
		{
			echo("Esta aqui");

			$logof = $validacao->Deslogar();
			if(!$logof)
			{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
				<script type= \"text/javascript\">
				alert(\"seja bem vindo {$resultado['nome']} \");
				</script>";
			}
			else
			{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
			<script type= \"text/javascript\">
			alert(\"Erro ao logar. Por favor verifique login e senha, tente novamente 2.\");
			</script>";
			}
		}
	}

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
		  <a class="navbar-brand" href="#">Medbook</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
			  <li class="nav-item"> <a class="nav-link" href="#">Link</a> </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a>
				  <div class="dropdown-divider"></div>
				  <a class="dropdown-item" href="#">Something else here</a> 
				</div>
			  </li>
			  <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php
					if(isset($_SESSION['usuarioNome']) && $_SESSION['usuarioNome'] != null)
					{ ?>
						<img class="rounded-circle" src='<?php echo "../../../imagens/".$_SESSION['usuarioImagem'];?>' alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
					<?php
						$conexao = new Conexao();
						$dalUsuario = new DALUsuario($conexao);
						echo($dalUsuario->primeiroNome($_SESSION['usuarioNome']));
					 ?>
						</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<table>
				  <tr>
					<td><a class="dropdown-item" href='../Alterar/AlterarUsuarioCompra.php?idPessoa=<?php echo $_SESSION['usuarioId'];?>'><img title="alterar informações do usuario" class="rounded-circle" src="../../../images/124654893.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Alterar informações</a>
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
					}
					else
					{
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
			  <form name="formBuscar" class="form-inline my-2 my-lg-0" action="../Busca/ResultadoBusca.php" target="_self" method="post">
				<div class="btn border-0"><input required="" name="buscar" class='btn btn border-0 text-center font-weight-bold' size="19" type="search" aria-label="Search"><!--<input name="procurar" class='align-baseline' type="image" id="procurar" title="Procurar" src="images/musica-searcher.png" alt="procurar" width="25" height="28" />-->
				<button class='btn border-0 text-center font-weight-bold' >
				<img src="../../../images/musica-searcher.png" width="25" height="28" /></button></div>
			  </form>
			<!-- PROCURAR VERDE -->

			<!-- PROCURAR VERDE
			  <form name="formBuscar" class="form-inline my-2 my-lg-0" action="Classes/View/Busca/ResultadoBusca.php" target="_self" method="post">
				<div class="btn-success border-0"><input required="" name="buscar" class='btn btn-success border-0 text-center font-weight-bold' size="19" type="search" aria-label="Search"><!--<input name="procurar" class='align-baseline' type="image" id="procurar" title="Procurar" src="images/musica-searcher.png" alt="procurar" width="25" height="28" />-->
				<!--
				<button class='btn-success border-0 text-center font-weight-bold' >
				<img src="images/musica-searcher.png" width="25" height="28" /></button></div>
			  </form>
			<!-- PROCURAR VERDE -->
		  </div>
		</nav>
		<section>
		  <!-- INICIO SLIDES -->
		  <!--
		  <div class="container">
			  <div class="container mt-3">
			  <div class="row">
				<div class="col-12">
				  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
					  <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
					  <li data-target="#carouselExampleControls" data-slide-to="1"></li>
					  <li data-target="#carouselExampleControls" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
					  <div class="carousel-item active">
						<img class="d-block w-100 img-fluid" src="../../../images/medicina-uma-profissao1.jpg" alt="First slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><strong>Uma profissão que cuidsa de vidas</strong></h5>
						  <p><strong>Medicina também é amor ao próximo</strong></p>
						</div>
					  </div>
					  <div class="carousel-item">
						<img class="d-block w-100 img-fluid" src="../../../images/medicina-uma-profissao3.jpg" alt="Second slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><strong>Uma profissão que cuidsa de vidas</strong></h5>
						  <p><strong>Medicina também é amor ao próximo</strong></p>
						  <p><strong>A síndrome de Down não é uma doença! Mas<br>a bem da verdade, exige alguns cuidados com a saúde</strong></p>
						</div>
					  </div>
						<div class="carousel-item">
						<img class="d-block w-100 img-fluid" src="../../../images/medicina-uma-profissao2.jpg" alt="Third slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><strong>Uma profissão que cuidsa de vidas</strong></h5>
						  <p><strong>Medicina também é amor ao próximo</strong></p>
						</div>
					  </div>
					<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
					</a>
				  </div>
				</div>
			  </div>
		   </div>-->
		<!-- FIM SLIDE -->
				  <br>
				  <br>
		<!-- INICIO GALERIA DE FOTOS -->
	  <hr>
	  <div class="container">
			<div class="row">
			  <div class="col-12 mb-2 text-center">
				<h2>FOTOS DE <?php echo(strtoupper($dalUsuario->primeiroNome($_SESSION['usuarioNome']))); ?> </h2>
			  </div>
			</div>
	  </div>
	  <hr>
	  <br>
	  <div class="container ">
			<div class="row">
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum dolor</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum dolor</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum dolor</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			  <div class="col-lg-4 col-md-6 col-sm-12 text-center">
				<img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/400X200.gif" data-holder-rendered="true">
				<h3>Lorem ipsum</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
			  </div>
			</div>
			<!-- FIM GALERIA DE FOTOS -->
		  <div class="container">
			<hr>
			  <div class="container">
					<div class="row">
					  <div class="col-12 mb-2 text-center">
						<h2>SOBRE <?php echo(strtoupper($dalUsuario->primeiroNome($_SESSION['usuarioNome']))); ?> </h2>
					  </div>
					</div>
			  </div>
			  <hr>
			<div class="row">
			  <div class="col-sm-6 col-lg-4">
				<h3>Feature Description</h3>
				<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt impedit est voluptatem doloremque architecto corporis suscipit quidem ratione! Quis laborum nam optio dolorem doloremque ex nobis quibusdam ad quo dolores? </p>
				<p><a class="btn btn-link" href="http://www.adobe.com">View details »</a></p>
			  </div>
			  <div class="col-sm-6 col-lg-4">
				<h3>Feature Description</h3>
				<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate, illo, libero esse assumenda culpa consequatur exercitationem beatae odio praesentium nihil iste ipsum reiciendis pariatur. Recusandae, reiciendis quidem eaque aut ab. </p>
				<p><a class="btn btn-link" href="http://www.adobe.com">View details »</a></p>
			  </div>
			  <div class="col-sm-6 col-lg-4">
				<h3>Feature Description</h3>
				<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, adipisci recusandae veniam laudantium distinctio temporibus eveniet dolorum earum iusto veritatis provident ducimus minima dolore quas vel omnis cumque voluptas quibusdam.</p>
				<p><a class="btn btn-link" href="http://www.adobe.com">View details »</a></p>
			  </div>
			</div>
	  </div>
		</section>
		<div class="container">
		  <div class="row">
			<div class="col-12 col-md-8 mx-auto">
			  <div class="jumbotron">
				<div class="row text-center">
				  <div class="text-center col-12">
					<h2>ENVIAR MENSAGEM</h2>
				  </div>
				  <div class="text-center col-12">
					<!-- CONTACT FORM https://github.com/jonmbake/bootstrap3-contact-form -->
					<form id="feedbackForm" class="text-center">
					  <div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-describedby="nameHelp">
						<span id="nameHelp" class="form-text text-muted" style="display: none;">Please enter your name.</span>
					  </div>
					  <div class="form-group">
						<label for="email">E-Mail</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" aria-describedby="emailHelp">
						<span id="emailHelp" class="form-text text-muted" style="display: none;">Please enter a valid e-mail address.</span>
					  </div>
					  <div class="form-group">
						<label for="message">Message</label>
						<textarea rows="10" cols="100" class="form-control" id="message" name="message" placeholder="Message" aria-describedby="messageHelp"></textarea>
						<span id="messageHelp" class="form-text text-muted" style="display: none;">Please enter a message.</span>
					  </div>
					  <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg"> Enviar</button>
					</form>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<footer class="text-center">
		  <div class="container">
			<div class="row">
			  <div class="col-12">
				<p>Copyright © Medbook. All rights reserved.</p>
			  </div>
			</div>
		  </div>
		</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
		<script src="../../../../js/jquery-3.2.1.min.js"></script> 
		<!-- Include all compiled plugins (below), or include individual files as needed --> 
		<script src="../../../../js/popper.min.js"></script> 
		<script src="../../../../js/bootstrap-4.0.0.js"></script>
	  </body>
	</html>
<?php
}
else
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=../../../index.php'>
	<script type= \"text/javascript\">
	alert(\"você não tem autorização para acessar a esta página.\");
	</script>";
}
?>