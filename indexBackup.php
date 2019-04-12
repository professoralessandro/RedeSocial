<?php session_start(); ?>
<?php include_once("Classes/Conexao/Conexao.php"); ?>
<?php include_once("Classes/Model/Usuario.php"); ?>
<?php include_once("Classes/Controller/DALUsuario.php"); ?>
<?php include_once("Classes/Conexao/Validacao.php"); ?>
<?php

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
			echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=Classes/View/Usuario/home.php'>
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
	else if(isset($_POST['deslogar']))
	{
		echo("Esta aqui");
		
		$logof = $validacao->Deslogar();
		if(!$logof)
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
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Medbook</a>
	<!--
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
					<img class="rounded-circle" src='<?php echo "imagens/".$_SESSION['usuarioImagem'];?>' alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
				<?php
				 	$conexao = new Conexao();
				 	$dalUsuario = new DALUsuario($conexao);
					echo($dalUsuario->primeiroNome($_SESSION['usuarioNome']));
				 ?>
					</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<table>
			  <tr>
				<td><a class="dropdown-item" href='Classes/View/Alterar/AlterarUsuarioCompra.php?idPessoa=<?php echo $_SESSION['usuarioId'];?>'><img title="alterar informações do usuario" class="rounded-circle" src="images/124654893.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Alterar informações</a>
                <div class="dropdown-divider">
				  </td>
			  </tr>
			<tr align="center">
				<td align="center">
				<a href="Classes/Conexao/sair.php">
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
			<!--
					<img class="rounded-circle" src="imagens/profile.png" alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
					<?php echo("Usuário"); ?> -->
			<?php } ?>
	
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
    <header>
		
		
      <div class="jumbotron">
		  <!-- INICIO SLIDES -->
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
						<img class="d-block w-100 img-fluid" src="images/medicina-uma-profissao1.jpg" alt="First slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><strong><font color="#000000">Uma profissão que cuida de vidas</strong></h5>
						  <p><strong>Medicina também é amor ao próximo</strong></font></p>
						</div>
					  </div>
					  <div class="carousel-item">
						<img class="d-block w-100 img-fluid" src="images/medicina-uma-profissao3.jpg" alt="Second slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><strong>A síndrome de Down não é uma doença!</strong></h5>
						  <p><strong>Mas a bem da verdade, exige alguns cuidados com a saúde</strong></p>
						</div>
					  </div>
						<div class="carousel-item">
						<img class="d-block w-100 img-fluid" src="images/medicina-uma-profissao2.jpg" alt="Third slide">
						<div class="carousel-caption d-none d-md-block">
						  <h5><font color="#000000"><strong>Uma rede social que ajuda você</strong></h5>
						  <p><strong>a se conectar com profissionais que podem lhe ajudar</strong></font></p>
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
		   </div>
		<!-- FIM SLIDE -->
		  		  <br>
				  <br>
        <div class="container">			
          <div class="row">
            <div class="col-12">
             	<!-- Content section Start -->
				  <!-- Form Envio documentos -->
				  <!--
				   <form name="formCadastroUsuario" action="#" target="_self" method="post" enctype="multipart/form-data">
				  -->
				  <?php if(isset($_SESSION['usuarioNome']))
					{ //header('Location:Classes/View/Loja/ConfirmarCompra.php');
						echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=Classes/View/Usuario/home.php'>";
					?>
				<?php }
					  else
					  {
					?>
				<!-- INICIO LOGIN -->
				   <form name="formLogarIndex" action="#" target="_self" method="post" >
					<section id="content">
					  <div class="container">
						<div class="jumbotron">
						<div class="row text-center">
						  <div class="form-control text-center col-12">
							  <h3>
								Log-in
							  </h3>
							  <form role="form" class="login-form">
								<div class="form-group">
								  <div class="input-icon">
									<i class="icon fa fa-user"></i>
									<input type="text" id="sender-email" class="form-control text-center" name="email" placeholder="Username">
								  </div>
								</div> 
								<div class="form-group">
								  <div class="input-icon">
									<i class="icon fa fa-unlock-alt"></i>
									<input name="senha" type="password" class="form-control text-center" placeholder="Password">
								  </div>
								</div>                
								  <br>
								<button  name="login" class="btn btn-block btn-lg btn-primary">Entrar</button>
							  </form>
							  <br>
							  <br>
							  <ul class="form-links">
								<li class="pull-left"><a href="signup.html">Don't have an account?</a></li>
								<li class="pull-right"><a href="forgot-password.html">Lost your password?</a></li>
							  </ul>
							</div>
						  </div>
						</div>
					  </div>
					</section>
				  </form>
				<?php } ?>
			<!-- Content section End -->
			</div>	
        </div>
      </div>
    </div>
<!-- fim login -->
	<br>
	<br>
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
    <script src="../js/jquery-3.2.1.min.js"></script> 
    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="../js/popper.min.js"></script> 
    <script src="../js/bootstrap-4.0.0.js"></script>
  </body>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap-4.0.0.js"></script>
  </body>
</html>