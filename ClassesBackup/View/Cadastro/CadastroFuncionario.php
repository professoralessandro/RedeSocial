<?php session_start(); ?>
<?php include_once("../../Model/Funcionario.php"); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Produto.php"); ?>
<?php include_once("../../Model/Compra.php"); ?>
<?php include_once("../../Model/Pessoa.php"); ?>
<?php include_once("../../Controller/DALFuncionario.php"); ?>
<?php include_once("../../Controller/DALCompra.php"); ?>
<?php include_once("../../Controller/DALPessoa.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php
if(isset($_SESSION['usuarioAcessoNiveis']) && $_SESSION['usuarioAcessoNiveis'] != null && $_SESSION['usuarioAcessoNiveis'] == 'Gerente')
{
	$conexao = new Conexao();
	$dalPessoa = new DALPessoa($conexao);
	$dalCompra = new DALCompra($conexao);
	$dalProduto = new DALProduto($conexao);
	$dalFuncionario = new DALFuncionario($conexao);
	$dalUsuario = new DALUsuario($conexao);
	//POST PHP
	if(isset($_POST['cadastrar']) && $_POST['cadastrar'] != null)
	{
		$nome = trim($_POST['nome']);
		
		//TRATAR CPF
		$cpf = trim($_POST['cpf']);
		$cpf = $dalUsuario->tratarCpf($cpf);
		
		//TRATAR RG
		$rg = trim($_POST['rg']);
		$rg = $dalUsuario->tratarCpf($rg);
		
		$dataNascimento = trim($_POST['dataNascimento']);
		$dataCadastro = date('Y-m-d');
		$sexo = trim($_POST['sexo']);
		$email = trim($_POST['email']);
		$nivelAcesso = trim($_POST['nivelAcesso']);
		
		//TRATAR DDD
		$ddd = trim($_POST['ddd']);
		$ddd = $dalUsuario->tratarDdd($ddd);
		
		//TRATAR TELEFONE
		$telefone = trim($_POST['telefone']);
		$telefone = $dalUsuario->tratarTelefone($telefone);
		
		//TRATAR DDD2
		$ddd2 = trim($_POST['ddd2']);
		$ddd2 = $dalUsuario->tratarDdd($ddd2);
		
		//TRATAR TELEFONE 2
		$telefone2 = trim($_POST['telefone2']);
		$telefone2  = $dalUsuario->tratarTelefone($telefone2);
		
		$escolaridade = trim($_POST['escolaridade']);
		$endereco = trim($_POST['endereco']);
		$complemento = trim($_POST['complemento']);
		$bairro = trim($_POST['bairro']);
		$cidade = trim($_POST['cidade']);
		$estado = trim($_POST['estado']);
		
		//TRATAR CEP
		$cep = trim($_POST['cep']);
		$cep = $dalUsuario->tratarCep($cep);
		
		$senha = trim($_POST['senha']);
		$confirmarSenha = trim($_POST['confirmarSenha']);
		$dataContratacao = trim($_POST['dataContratacao']);
		$dataDemissao = trim($_POST['dataDemissao']);
		$dataContratacao = trim($_POST['dataContratacao']);
		$comentarioContratacao = trim($_POST['comentarioContratacao']);
		$comentarioDemissao = trim($_POST['comentarioDemissao']);
		$expProfissional = trim($_POST['expProfissional']);
		$cargo = trim($_POST['cargo']);
		$gerenteResp = trim($_POST['gerenteResp']);
		$historico = trim($_POST['historico']);
		$departamento = trim($_POST['departamento']);
		$imagem = trim($_FILES['imagem']['name']);
		$temp = trim($_FILES['imagem']['tmp_name']);
		$size = trim($_FILES['imagem']['size']);

		if(isset($_POST['nome']) && $_POST['nome'] != null  && isset($_POST['cpf']) && $_POST['cpf'] != null && isset($_POST['dataNascimento']) && $_POST['dataNascimento'] != null && isset($_POST['sexo']) && $_POST['sexo'] != null && isset($_POST['nivelAcesso']) && $_POST['nivelAcesso'] != null && isset($_POST['ddd']) && $_POST['ddd'] != null && isset($_POST['email']) && $_POST['email'] != null && isset($_POST['telefone']) && $_POST['telefone'] != null && isset($_POST['endereco']) && $_POST['endereco'] != null && isset($_POST['cidade']) && $_POST['cidade'] != null && isset($_POST['estado']) && $_POST['estado'] != null && isset($_POST['cep']) && $_POST['cep'] != null && isset($_POST['senha']) && $_POST['senha'] != null && isset($_POST['confirmarSenha']) && $_POST['confirmarSenha'] != null && isset($_POST['cargo']) && $_POST['cargo'] != null  && isset($_POST['gerenteResp']) && $_POST['gerenteResp'] != null && isset($_POST['departamento']) && $_POST['departamento'] != null && isset($_POST['dataContratacao']) && $_POST['dataContratacao'] != null)
		{
			if($_POST['senha'] == $_POST['confirmarSenha'])
			{
				$funcionario = new Funcionario(1, $cpf, $dataContratacao, $comentarioContratacao, $dataDemissao, $comentarioDemissao, $escolaridade, $expProfissional, $cargo, $gerenteResp, $historico,$nome, $dataNascimento, $dataCadastro, $email, $nivelAcesso, $ddd, $telefone, $ddd2, $telefone2, $endereco, $complemento, $bairro, $cidade, $estado, $cep, $sexo, $senha,$rg,$departamento, $imagem);

				move_uploaded_file($temp,"../../../imagens/".$imagem);

				//print_r($funcionario);

				//header("Location: CadastroUsuario.php");

				$cadastroOK = $dalFuncionario->cadastrarFuncionario($funcionario);

				if(!$cadastroOK)
				{
						echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/index.php'>
						<script type= \"text/javascript\">
						alert(\"O funcionário $nome foi cadastrado com sucesso.\");
						</script>";
				}
				else
				{
						echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/Classes/View/Cadastro/CadastroFuncionario.php'>
						<script type= \"text/javascript\">
						alert(\"Erro ao cadastrar funcionário. Tente novamente\");
						</script>";
				}//CADASTROBANCO
			}//SENHAS IGAUS
			else
			{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/Classes/View/Cadastro/CadastroFuncionario.php'>
					<script type= \"text/javascript\">
					alert(\"Erro ao cadastrar funcionário. Por favor verifique as senhas e tente novamente\");
					</script>";
			}//SENHAS IGUAIS	
		}//IFCAMPOSOBRIGATORIOS
		else
		{
				echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/Classes/View/Cadastro/CadastroFuncionario.php'>
				<script type= \"text/javascript\">
				alert(\"Erro ao cadastrar funcionário. Por favor verifique os campos obrigatórios e tente novamente\");
				</script>";
		}//IFCAMPOSOBRIGATORIOS
	}//IFBOTAO

	//FIM POST PHP
	?>
	<!DOCTYPE html>
	<html lang="en">
	  <head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cadastro de funcionário</title>
		<!-- Bootstrap -->
		<link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
		<link rel="shortcut icon" type="image/x-icon" href="../../../images/favicon.jpg" />
  </head>
  <body>
    <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" role="navigation" >
      <div class="container">
		<img src="../../../images/logo.png" width="115" height="55" title="Logo Chayds" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
           <!-- BOTOES ADICIONAIS
            <li class="nav-item active"> <a class="nav-link" href="#">Início<span class="sr-only">(current)</span></a> </li>
            FIM BOTOES ADICIONAIS -->
            <li class="nav-item"> <a class="nav-link" href="../../../index.php"><img class="rounded-circle" src="../../../images/336583.png" alt="Loja" width="30" height="30" id="imagem" title="Loja" />&nbsp;Loja</a> </li>
            <li class="nav-item"> <a class="nav-link" href="../Contato/ContatoChayds.php"><img title="Suporte" class="rounded-circle" src="../../../images/support3.png" width="30" height="30" />&nbsp;Contato</a></li>
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php
				if(isset($_SESSION['usuarioNome']) && $_SESSION['usuarioNome'] != null)
				{ ?>
					<img class="rounded-circle" src='<?php echo "../../../imagens/".$_SESSION['usuarioImagem'];?>' alt="foto de perfil" width="33" height="33" id="imagem" title="foto de perfil" />
				<?php $usu = $_SESSION['usuarioNome'];
					echo($dalPessoa->primeiroNome($usu));
				 ?>
					</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href='../Alterar/AlterarUsuarioCompra.php?idPessoa=<?php echo $_SESSION['usuarioId'];?>'><img class="rounded-circle" src="../../../images/124654893.png" width="35" height="37" />&nbsp;Alterar informações</a>
                <!--<a class="dropdown-item" href="../../../images/support.png"><img class="rounded-circle" src="../../../images/support.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Suporte chayds</a>-->
                <div class="dropdown-divider"></div>
			<table>
			<?php
			
			$compra = new Compra(0, $_SESSION['usuarioId'], '', $_SESSION['usuarioNome'], $_SESSION['usuarioEmail'], '', '', '', '', $valorTotal = 0, $_SESSION['usuarioCPF'], 30, '', '', '', '', '');
			
			//print_r($compra);
			
			$resultado = $dalCompra->contadorCompraCarrinho($compra);
			
			//echo("Retorno Test Funcao". $resultado); 
			
			$contadorCarrinho = 0;
				 
			while($dados = mysqli_fetch_array($resultado))
			{
				$contadorCarrinho += $dados['quantidadeProduto'];
				
				if($contadorCarrinho == 9)
				{
					break;
				}
				else if($contadorCarrinho > 10)
				{
					$contadorCarrinho = 10;
					break;
				}
			}//WHILE CONTADOR CARRINHO
			?>
			  <tr>
				<td><a class="dropdown-item" href="../Loja/ConfirmarCompraCarrinho.php"><img class="rounded-circle" src="../../../images/carrioverde<?php echo $contadorCarrinho; ?>.png" alt="foto de perfil" width="43" height="33" id="imagem" title="Carrinho de compras" />&nbsp;Carrinho de compras</a>
				  </td>
			  </tr>
		<?php 
				$contadorMensagem = 0;
				 if(isset($contadorMensagem) & $contadorMensagem > 0)
				{?>
			<tr>
				<td><a class="dropdown-item" href="#">Avisos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  <img class="rounded-circle" src="images/email<?php echo $contadorMensagem; ?>.png" width="43" height="33" class="rounded-circle" alt="Email" title="Avisos chayds"></a></td>
			</tr>
		<?php } ?>
			<tr align="center">
				<td align="center">
				<a href="../../../bd/valida/sair.php">
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
					<img class="rounded-circle" src="../../../imagens/profile.png" alt="foto de perfil" width="33" height="33" id="imagem" title="foto de perfil" />
					<?php echo("Usuário"); ?>
					</a>
	<div align="center" class="dropdown-menu" aria-labelledby="navbarDropdown">
		<form name="formLogin" action="../../../bd/valida/validateste.php" target="_self" method="post">
			<table align="center">
              <tr>
				<div class='border-0'><td><img class="rounded-circle" src="../../../images/user-silhouette.png" width="35" height="37" /></td><td>&nbsp;<input class="alert border-0 text-center" name="email" type="email" required="required" id="celular" placeholder="Informe o seu email (Obrigatório)" title="email" size="30" maxlength=50"></div>
			    </td>
			  </tr>
			  <tr>
				<div class='border-0'><td><img class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></td><td>&nbsp;<input name="senha" type="password" class="alert border-0 text-center" required="required" id="endereco" placeholder="Informe a senha (Obrigatório)" title="Senha" size="30" maxlength=50"></div>
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
                <td align="center"><br><a class="dropdown-item" href="../Usuario/CadastroSimplesUsuario.php">Cadastrar-se</a>
				</td>
				</tr>
		     
			</table>
			</form>
            </li> <!--  FIM DO MENU DROP COM USUARIO DESLOGADO -->
				<?php /* FIM DO MENU DROP COM USUARIO DESLOGADO */ } ?>
            <!-- SEGUNDO MENU DROP
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuário</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Alterar informações</a>
                <a class="dropdown-item" href="#">Enviar mensagem</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Carrinho de compras</a>
              </div>
            </li>
            FIM SEGUNDO MENU DROP -->
		    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img title="Redes sociais" class="rounded-circle" src="../../../images/1488003.png" width="30" height="30" />&nbsp;&nbsp;Redes Sociais</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../Posts/Instagram.php"><img title="Instagram" class="rounded-circle" src="../../../images/1.gif" width="30" height="30" />&nbsp;Instagram</a>
				<div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../Posts/FacebookPosts.php"><img title="Instagram" class="rounded-circle" src="../../../images/2.gif" width="30" height="30" />&nbsp;Facebook</a>
                <div class="dropdown-divider"></div>
				<a class="dropdown-item" href="../Videos/Videos.php"><img title="Instagram" class="rounded-circle" src="../../../images/quanto-custa-anunciar-no-youtube.png" width="30" height="30" />&nbsp;Youtube</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="../Posts/Twitter.php"><img title="Twitter" class="rounded-circle" src="../../../images/3.gif" width="30" height="30" />&nbsp;Twitter</a>
              </div>
            </li>
		  <!-- IMAGENS
		    <li class="nav-item">
              <a class="nav-link disabled" href="Classes/View/Imagens/Imagens.php">Imagens</a>
            </li>
		  -->
	<?php
		  if(isset($_SESSION['usuarioAcessoNiveis']) && $_SESSION['usuarioAcessoNiveis'] == 'Gerente')
		  { ?>
		    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastrar</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../Cadastro/CadastroUsuario.php">Usuário</a>
				<a class="dropdown-item" href="../Cadastro/CadastroFuncionario.php">Funcionário</a>
				<a class="dropdown-item" href="../Cadastro/CadastroEmpresa.php">Empresa</a>
				<a class="dropdown-item" href="../Cadastro/CadastroDepartamento.php">Departamento</a>
				<a class="dropdown-item" href="../Cadastro/CadastroProduto.php">Produto</a>
				<!--<a class="dropdown-item" href="Classes/View/Cadastro/CadastroCarrinho.php">Carrinho</a>-->
				<!--<a class="dropdown-item" href="#">Email</a>-->
                <!--<a class="dropdown-item" href="#">Enviar mensagem</a>-->
				<!--<a class="dropdown-item" href="#">Imagem</a>-->
				<!--<a class="dropdown-item" href="#">Vídeo</a>-->
              </div>
            </li>
		    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listar</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../Busca/ListaUsuario.php">Usuários</a>
				<a class="dropdown-item" href="../Busca/ListaFuncionario.php">Funcionários</a>
				<a class="dropdown-item" href="../Busca/ListaEmpresa.php">Empresas</a>
				<a class="dropdown-item" href="../Busca/ListaDepartamento.php">Departamentos</a>
				<a class="dropdown-item" href="../Busca/ListaProduto.php">Produtos</a>
				<a class="dropdown-item" href="../Busca/ListaCompra.php">Compras</a>
				<!--<a class="dropdown-item" href="Classes/View/Busca/ListaCarrinho.php">Carrinhos</a>-->
				<!--<a class="dropdown-item" href="#">Log</a>-->
				<!--<a class="dropdown-item" href="#">Email</a>-->
                <!--<a class="dropdown-item" href="#">Mensagem</a>-->
				<!--<a class="dropdown-item" href="#">Imagens</a>-->
				<!--<a class="dropdown-item" href="#">Vídeos</a>-->
              </div>
            </li>
		  <?php } ?>
			  <!-- PROXIMAS LINHAS
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
				-->
		  <!-- SEGUNDO MENU DROP
            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuário</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Alterar informações</a>
                <a class="dropdown-item" href="#">Enviar mensagem</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Carrinho de compras</a>
              </div>
            </li>
            -->
          </ul>
          <!-- PROCURAR -->
          <form name="formBuscar" class="form-inline my-2 my-lg-0" action="../Busca/ResultadoBusca.php" target="_self" method="post">
            <div class="btn-secondary border-0"><input name="buscar" class='btn btn-secondary border-0 text-center font-weight-bold' size="19" type="search" aria-label="Search"><!--<input name="procurar" class='align-baseline' type="image" id="procurar" title="Procurar" src="images/musica-searcher.png" alt="procurar" width="25" height="28" />-->
			<button class='btn-secondary border-0 text-center font-weight-bold' >
			<img src="../../../images/musica-searcher.png" width="25" height="28" /></button></div>
          </form>
          <!-- FIM PROCURAR -->
        </div>
      </div>
    </nav>
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
					<img class="d-block w-100 img-fluid" src="../../../images/52b9979b-2d7d-4894-8e6f-86d6e02af264.jpg" alt="First slide">
					<div class="carousel-caption d-none d-md-block">
					  <h5><strong>ONE MAN</strong></h5>
					  <p><strong>Complexo Vitaminico completo feito</strong></p>
					  <p><strong>para homens 120 capsulas </strong></p>
					</div>
				  </div>
				  <div class="carousel-item">
					<img class="d-block w-100 img-fluid" src="../../../images/f86c801f-e597-4692-b819-f7a53d77b270.jpg" alt="Second slide">
					<div class="carousel-caption d-none d-md-block">
					  <h5><strong>ONE GIRL</strong></h5>
					  <p><strong>Complexo Vitaminico completo feito</strong></p>
					  <p><strong>para mulher 120 Capsulas</strong></p>
					</div>
				  </div>
					<div class="carousel-item">
					<img class="d-block w-100 img-fluid" src="../../../images/2.png" alt="Third slide">
					<div class="carousel-caption d-none d-md-block">
					  <h5><strong>Maca Black</strong></h5>
					  <p><strong>Suplemento Vitaminico Maca 120 Capsulas&nbsp;</strong></p>
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
			<div class="col-12">&nbsp;</div>
		  <hr>
		</div>
		<div class="container">
		  <div class="row">
			<div class="col-4">
			  <div class="row">
				<div class="col-2"><img src="../../../images/img2.png" alt="Free Shipping" width="40" height="40" class="rounded-circle"></div>
				<div class="col-lg-6 col-10 ml-1">
				  <h4>Frete Grátis</h4>
				</div>
			  </div>
			</div>
			<div class="col-4">
			  <div class="row">
				<div class="col-2"><img src="../../../images/img7.jpg" alt="Free Shipping" width="40" height="40" class="rounded-circle"></div>
				<div class="col-lg-6 col-10 ml-1">
				  <h4>Devolução Grátis</h4>
				</div>
			  </div>
			</div>
			<div class="col-4">
			  <div class="row">
				<div class="col-2"><img src="../../../images/img6.jpg" alt="Free Shipping" width="40" height="40" class="rounded-circle"></div>
				<div class="col-lg-6 col-10 ml-1">
				  <h4>Preço Baixo</h4>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<hr>
		<h2 class="text-center">CADASTRO DE FUNCIONÁRIO</h2>
		<hr>
	<form name="formCadastroFuncionario" action="#" target="_self" method="post" enctype="multipart/form-data">
		<div class="container" align="center">
		  <table class="form_menu2" align="center">
			<tr>
			  <td align="center"><label for="nome"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="nome de usuário" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="nome" type="text" required="required" id="nome" placeholder="Informe o seu nome completo " title="Nome" size="25" maxlength=50">&nbsp;
		    </td>
			  <td align="center"><label for="cpf"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="cpf" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="cpf" type="text" required="required" id="cpf" placeholder="Informe o CPF" title="CPF" size="25" maxlength=50">&nbsp;
		    </td>
			  <td align="center"><label for="rg"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="rg" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="rg" type="text" required="required" id="rg" placeholder="Informe o RG" title="RG" size="25" maxlength=50">&nbsp;
		  </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
          <td align="center"><label for="sexo"><font class="font-weight-bold" color="#ff0000">*</font>
			<img title="sexo" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;
              <input class='btn btn-group border-0 text-center font-weight-bold' name="sexo" type="radio" id="sexo" title="Sexo masculino" value="F"><h5 class='btn btn-group border-0 text-center font-weight-bold'>
				  Feminino</h5>
              <input class='btn btn-group border-0 text-center font-weight-bold' name="sexo" type="radio" id="sexo" title="Sexo Feminino" value="M">
				  <h5 class='btn btn-group border-0 text-center font-weight-bold'>Masculino</h5>
			  </td>
			  <td align="center"><label for="email"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="Email" class="rounded-circle" src="../../../images/email3.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="email" type="email" required="required" id="email" placeholder="Informe o seu email" title="email" size="25" maxlength="50">&nbsp;
		  	  </td>
			  <td align="center"><label for="dataNascimento"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="dataNascimento" class="rounded-circle" src="../../../images/61469.svg" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="dataNascimento" type="date" required="required" id="dataNascimento" title="data de nascimento" size="25 maxlength="50">&nbsp;
			</td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="expProfissional">
              <img title="expProfissional" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="expProfissional" type="text" id="expProfissional" placeholder="Informe a experiencia profissional" title="expProfissional" size="25" maxlength="50">&nbsp;
		  </td>
			  <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
				<label for="cargo">
              <img title="cargo" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>
				  <select name="cargo" required="required" class='btn btn-group border-0 text-center font-weight-bold' id="cargo" title="cargo" type="text">
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Cargo 1">Cargo 1</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Cargo 2">Cargo 2</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Cargo 3">Cargo 3</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Sem Cargo">Sem Cargo</option>    
			  </select></td>
			  <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
			  <label for="gerenteResp">
              <img title="Gerente responsável" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>
				<font color="#000000">
				  <select name="gerenteResp" class='btn btn-group border-0 text-center font-weight-bold' required id="gerenteResp" title="Nivel de acesso" type="text">
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Gerente 1">Gerente 1</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Gerente 2">Gerente 2</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Gerente 3">Gerente 3</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Sem Gerente">Sem Gerente</option>  
				  </select>
				</td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="nivelAcesso"><font class="font-weight-bold" color="#ff0000">*</font>
			  <img title="nivelAcesso" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>&nbsp;
              <select name="nivelAcesso" required="required" class='btn btn-group border-0 text-center font-weight-bold' id="nivelAcesso" title="Nivel de acesso" type="text">
                <option class='btn btn-group border-0 text-center font-weight-bold' value="Gerente">Gerente</option>
                <option class='btn btn-group border-0 text-center font-weight-bold' value="Acessor">Acessor</option>
                <option class='btn btn-group border-0 text-center font-weight-bold' value="Cliente">Cliente</option>
                <option class='btn btn-group border-0 text-center font-weight-bold' value="Usuário">Usuario</option>
              </select>&nbsp;
            </td>
			  <td align="center"><label for="ddd"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="ddd" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="ddd" type="text" required="required" id="ddd" placeholder="Informe o DDD" title="DDD" size="10" maxlength="50">&nbsp;
          	  </td>
			  <td align="center"><label for="telefone"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="telefone" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="telefone" type="text" required="required" id="telefone" placeholder="Informe o seu telefone, somente os números" title="Telefone" size="25" maxlength="50">&nbsp;
              </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="ddd2">
              <img title="ddd2" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="ddd2" type="text" id="ddd2" placeholder="Informe o DDD2" title="DDD2" size="10" maxlength=50">&nbsp;
          </td>
			  <td align="center"><label for="telefone2">
              <img title="telefone2" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="telefone2" type="text" id="telefone2" placeholder="Informe o celular" title="Telefone" size="25" maxlength=50">&nbsp;
              </td>
			  <td align="center"><label for="escolaridade"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="escolaridade" class="rounded-circle" src="../../../images/70035study.svg" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="escolaridade" type="text" required="required" id="escolaridade" placeholder="Informe a escolaridade" title="escolaridade" size="25" maxlength="50">&nbsp;
              </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="endereco"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="endereco" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="endereco" type="text" required="required" id="endereco" placeholder="Informe o logradouro" title="endereco" size="25" maxlength="50">
              </td>
			  <td align="center"><label for="complemento">
              <img title="complemento" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="complemento" type="text" id="complemento" placeholder="Informe o complemento" title="Complemento" size="25" maxlength="50">&nbsp;
              </td>
			  <td align="center"><label for="bairro">
              <img title="bairro" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="bairro" type="text" id="bairro" placeholder="Informe o bairro" title="Bairro" size="25" maxlength="50">&nbsp;
              </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="cidade"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="cidade" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="cidade" type="text" required="required" id="cidade" placeholder="Informe a cidade" title="Cidade" size="25" maxlength="50">&nbsp;
              </td>
			  <td align="center"><label for="estado"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="estado" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<select class='btn btn-group border-0 text-center font-weight-bold' name="estado" id="estado" required="required" type="text">
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="AC">Acre</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="AL">Alagoas</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="AP">Amapá</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="AM">Amazonas</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="BA">Bahia</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold value="CE">Ceará</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="DF">Distrito Federal</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="ES">Espírito Santo</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="GO">Goiás</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="MA">Maranhão</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="MT">Mato Grosso</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="MS">Mato Grosso do Sul</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="MG">Minas Gerais</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="PA">Pará</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="PB">Paraíba</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold value="PR">Paraná</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="PE">Pernambuco</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="PI">Piauí</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="RJ">Rio de Janeiro</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="RN">Rio Grande do Norte</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="RS">Rio Grande do Sul</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="RO">Rondônia</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="RR">Roraima</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="SC">Santa Catarina</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="SP">São Paulo</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="SE">Sergipe</option>
				  <option class='btn btn-group border-0 text-center font-weight-bold' value="TO">Tocantins</option>
				</select>&nbsp;
            </td>
			  <td align="center"><label for="cep"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="cep" class="rounded-circle" src="../../../images/1175922.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="cep" type="text" required="required" id="cep" placeholder="Informe o cep" title="CEP" size="25" maxlength="50">&nbsp;
          	  </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="historico">
              <img title="historico" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="historico" type="text" id="historico" placeholder="Informe o histórico do funcionário" title="historico" size="25" maxlength="50">&nbsp;
              </td>
			  <td align="center"><label for="senha"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="senha" class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="senha" type="password" required="required" id="senha" placeholder="Informe a senha" title="Senha" size="25" maxlength=50">&nbsp;
            </td>
			  <td align="center"><label for="confirmarSenha"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="confirmarSenha" class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="confirmarSenha" type="password" required="required" id="confirmarSenha" placeholder="Confirmar a senha" title="confirmarSenha" size="25" maxlength=50">&nbsp;
            </td>
			</tr>
			<tr>
			<td><p>&nbsp;</p></td>
			</tr>
			<tr>
			  <td align="center"><label for="dataContratacao"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="dataContratacao" class="rounded-circle" src="../../../images/61469.svg" width="35" height="37" /></label>&nbsp;<input name="dataContratacao" type="date" required="required" class='btn btn-group border-0 text-center font-weight-bold' id="dataContratacao" title="dataContratacao" size="25" maxlength="50">&nbsp;
			  </td>
			  <td align="center"><h5>Selecionar imagem:</br><font color="#ff0000"> Tamanho máximo 4MB</font></h5>
              <blockquote>
              &nbsp;<input class='btn btn-group border-0 text-center font-weight-bold'  name="imagem" type="file" id="imagem" title="imagem" size="30" maxlength=50">&nbsp;
			  </td>
			<td align="center"><label for="departamento"><font class="font-weight-bold" color="#ff0000">*</font>
              <img title="departamento" class="rounded-circle" src="../../../images/10Mala.svg" width="35" height="37" /></label>&nbsp;</label>
				  <select name="departamento" required="required" class='btn btn-group border-0 text-center font-weight-bold' id="departamento" title="Nivel de acesso" type="text">
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Loja 1">Loja 1</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Loja 3">Loja 3</option>
					<option class='btn btn-group border-0 text-center font-weight-bold' value="Loja 2">Loja 2</option>
				  </select>
			  </td>
			</tr>
		</table>
		<table class="form_menu2" align="center">
			<tr>
			  <td align="center"><h5>Conmentários Contratação:</h5>
				<font color="#000000">
				<blockquote>
				  <textarea class='btn btn-group border-0 text-center font-weight-bold' name="comentarioContratacao" cols="65" rows="7" maxlength="3024" id="comentarioContratacao" placeholder="Informe algo adicional" title="Comentario Contratacao"></textarea>
				</blockquote></td>
			</tr>
		  </table>
		<tr>
			<input name="cadastrar" type="submit" class="btn btn-primary" id="cadastrar" title="cadastrar" value="Cadastrar" />
			<!--<p align="right"><a href="#" class="btn btn-primary">Cadastrar</a></p>-->
		  </tr>
		</div>
	</form>
		<hr>
		<div class="container text-white bg-dark p-4">
		  <div class="row">
			<div class="col-6 col-md-8 col-lg-7">
			  <div class="row text-center">
				<div class="col-sm-6 col-md-4 col-lg-4 col-12">
				  <ul class="list-unstyled">
					<li class="btn-link"> <a>Manter a boa forma</a></li>
					<li class="btn-link"> <a>Ganho de força</a></li>
					<li class="btn-link"> <a>Ganho de vitalidade</a></li>
					<li class="btn-link"> <a>Ganho de cognição</a></li>
					<li class="btn-link"> <a>Emagrecimento</a></li>
				  </ul>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-12">
				  <ul class="list-unstyled">
					<li class="btn-link"> <a>Dietas Chayds</a></li>
					<li class="btn-link"> <a>Dietas</a></li>
					<li class="btn-link"> <a>Receitas light</a></li>
					<li class="btn-link"> <a>Receitas veganas</a></li>
					<li class="btn-link">Receitas balanceadas</li>
				  </ul>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4 col-12">
				  <ul class="list-unstyled">
					<li class="btn-link"> <a>Exercicios físicos</a></li>
					<li class="btn-link"> <a>Massa muscular</a></li>
					<li class="btn-link"> <a>extresse</a></li>
					<li class="btn-link"> <a>Qualidade de vida</a></li>
					<li class="btn-link">Bem estar</li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-md-4 col-lg-5 col-6">
			  <address>
			  <strong>Chayd`s Vitamins, Supplements and Minerals</strong><br>
	Importadora Brasileira<br>
	<a href="#" target="_self"><img src="../../../images/icon_phone.png" alt="Telefone" width="25" height="25" class="rounded-circle img-fluid"></a> +55 13 9 9644 2358<br>
	<abbr><a href="#" target="_self"><img src="../../../images/icon_whatsapp.png" alt="Whatsapp""" width="25" height="25" class="rounded-circle img-fluid"../../images/icon_phone.png></a></abbr> +55 13 9 9644 2358
			  </address>
			  <address>
			  <strong>Serviço de Atendimento ao Cliente</strong><br>
			  <a href="#" target="_self"><img src="../../../images/email.svg" width="25" height="25" class="rounded-circle" alt="Email"></a>&nbsp;</a><a href="../Contato/ContatoChayds.php">sac@chayds.com.br</a>
			  </address>
			  <address>
			  <a href="https://www.facebook.com/vita.chayds.3" target="_blank"><img src="../../../images/2.gif" alt="Facebook" width="50" height="50" class="rounded-circle img-fluid"></a>&nbsp;&nbsp;<a href="#" target="_self"><img src='../../../images/3.gif' alt="Twitter" width="50" height="50" class="rounded-circle"></a>&nbsp;&nbsp;<a href="#" target="_self"><img src="../../../images/7.gif" alt="Youtube" width="50" height="50" class="rounded-circle img-fluid"></a>&nbsp;&nbsp;<a href="#" target="_self"><img src="../../../images/1.gif" alt="Instagran" width="50" height="50" class="rounded-circle"></a><!--&nbsp;&nbsp;<a href="https://allgoldenstars.webs.com/" target="_blank"><img src="../../images/ags1.jpg" alt="All Golden Stars" width="50" height="50" class="rounded-circle"></a>-->

			  </address>
			</div>
		  </div>
		</div>
		<footer class="text-center">
		  <div class="container">
			<div class="row">
			  <div class="col-12">
				<p>Copyright © Chayd`s. All rights reserved.</p>
			  </div>
			</div>
		  </div>
		</footer>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="../../../js/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../../js/popper.min.js"></script>
		<script src="../../../js/bootstrap-4.0.0.js"></script>
	  </body>
	</html>
<?php
}
else
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://www.chayds.com.br/index.php'>
		<script type= \"text/javascript\">
		alert(\"Você não tem autorização.\");
		</script>";
}