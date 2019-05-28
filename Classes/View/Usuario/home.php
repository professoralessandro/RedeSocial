<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Model/Comentario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Controller/DALComentario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>
<?php
$idUsuario = trim(filter_input(INPUT_GET, 'idUsuario', FILTER_SANITIZE_NUMBER_INT));
if (is_null($idUsuario) || $idUsuario == '') {
    $idUsuario = $_SESSION['usuarioId'];
}

if (isset($_SESSION['usuarioNome']))
{

    $comexao = new Conexao();
    $dalUsuario = new DALUsuario($comexao);

    if (isset($_POST['enviarMensagem'])) {
        // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
        date_default_timezone_set('America/Sao_Paulo');
        // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
        $dataHora = date('d/m/Y H:i:s', time());

        $dalComentario = new DALComentario($comexao);

        $idUsuario = $_SESSION['usuarioId'];
        $idDestinatario = $_POST['idDestinatario'];
        $nomeUsuario = $_SESSION['usuarioNome'];
        $email = $_SESSION['usuarioEmail'];
        $comentario = $_POST['message'];

        $comentario = new Comentario('', $idDestinatario, $idUsuario, $dataHora, $email, $nome, $comentario);
        
        $result = $dalComentario->comentar($comentario);

        if (!$result) {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"O comentário foi postado com sucesso.\");
            </script>";
        } else {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"Erro ao postar o comentário. Tente novamente mais tarde.\");
            </script>";
        }
    }
	else if (isset($_POST['responderMensagem']))
	{
		$conexao = new Conexao();
		$dalComentario = new DALComentario($conexao);
		
		$idComentario = $_POST['idComentario'];
		
		$resposta = $_POST['message'];
		
		$comentario = $dalComentario->localizarComentario($idComentario);
		
		$dados1 = mysqli_fetch_array($comentario);
		
		$resultResposta = $dalComentario->responderComentario($dados1, $resposta);
		
		if (!$resultResposta) {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"A sua resposta foi inserida com sucesso.\");
            </script>";
        } else {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"Erro ao responder o comentario. Tente novamente mais tarde.\");
            </script>";
        }
		
		
	}
	else if(isset($_POST['adicionarAmigo']))
	{
		$conexao = new Conexao();
		$dalUsuario = new DALUsuario($conexao);
		
		$usuario = $dalUsuario->localizarUsuario($_SESSION['usuarioId']);
		
		$dados1 = mysqli_fetch_array($usuario);
		
		$idAmigo = $_POST['idAmigo'];
		
		$ultimoAmigo = $_POST['idUltimoAmigo'];
		
		$resultAmigo = $dalUsuario->inserirAmigo($dados1, $idAmigo);
		
		if (!$resultAmigo) {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"O seu novo amigo foi adicionado com sucesso.\");
            </script>";
        } else {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"Erro ao adicionar um novo amigo. Tente novamente mais tarde.\");
            </script>";
        }
	}
	
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Home Page</title>
            <!-- Bootstrap -->
            <link href="../../../../css/bootstrap-4.0.0.css" rel="stylesheet">
        </head>
        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <img class="rounded-circle" src="../../../images/logotipoMedBook.jpg" width="45" height="45" title="Logo tipo" />
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"> <a class="nav-link" href='home.php?idUsuario=<?php echo $_SESSION['usuarioId']; ?>''>Home <span class="sr-only">(current)</span></a> </li>
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
                <br>
                <br>
                <!-- INICIO SOBRE UDUARIO -->
                <div class="container">
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 mb-2 text-center">
                                <h2>SOBRE <?php
                    $resultado = $dalUsuario->localizarUsuario($idUsuario);
                    $dados = mysqli_fetch_array($resultado);
                    echo(strtoupper($dados['nome']));
                    ?> </h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <table class="table table">
                            <tr>
                                <?php
                                for ($i = 1; $i < 4; $i ++) {
                                    if (isset($dados['titulo' . $i]) && $dados['titulo' . $i] != null && $dados['titulo' . $i] != '' && isset($dados['descricao' . $i]) && $dados['descricao' . $i] != null && $dados['descricao' . $i] != '') {
                                        ?>
                                        <th>
                                            <div class="row">
                                                <div class="col-sm-8 col-lg-12">
                                                    <h2><?php echo($dados['titulo' . $i]); ?></h2>
                                                    <h4><?php echo($dados['descricao' . $i]); ?></h4>
                                                </div>
                                            </div>    
                                        </th>
            <?php
        }
    }
    ?>          
                            </tr>
                        </table>
                    </div>
            </section>
            <!-- FIM SOBRE USUARIO -->
            <!-- INICIO GALERIA DE FOTOS -->
            <div class="container">
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-12 mb-2 text-center">
                            <h2>AMIGOS DE <?php echo(strtoupper($dados['nome'])); ?> </h2>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <div class="container ">
                    <div class="row">
    <?php
    for ($i = 1; $i < 7; $i ++)
	{
		$idUltimoAmigo = 0;
        if (isset($dados['idAmigo' . $i]) && $dados['idAmigo' . $i] != null)
		{
            //$conexao = new Conexao(); 
            //$dalUsuario = new DALUsuario($conexao);
            $resultadoAmigo = $dalUsuario->localizarUsuario($dados['idAmigo' . $i]);
            $dadosAmigo = mysqli_fetch_array($resultadoAmigo);
            ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 text-center">
                                    <img class="rounded-circle" alt="140x140" style="width: 140px; height: 140px;" src="../../../imagens/<?php echo($dadosAmigo['imagem']); ?>" data-holder-rendered="true">
                                    <h2><?php echo($dadosAmigo['nome']); ?></h2>
                                    <h4><?php echo($dalUsuario->primeiroNome($dadosAmigo['descricao' . $i])); $idUltimoAmigo ++ ?></h4>
                                </div>
        <?php }
			  else
			  {
				  $idUltimoAmigo = 'n';
			  }
						?>
                        <?php } ?>
                    </div>
                    <!-- FIM GALERIA DE AMIGOS -->
                    <?php
						if($dados['idUsuario'] == $_SESSION['usuarioId'])
						{
							
						}
						else
						{ ?>
						<hr>
							<div class="container">
                   <form name="AdicionarAmigo" action="#" target="_self" method="post">
                    <div class="row">
                        <div align="right" class="col-20 mb-2"><!-- IMAGEM MAIS <img class="rounded-circle" src="../../../images/adicionar-botao_318-32466.png" width="25" height="25" />-->
                          	<input hidden="" name="idUltimoAmigo" type="text" value="<?php echo($idUltimoAmigo); ?>" >
                          	<input hidden="" name="idAmigo" type="text" value="<?php echo($dados['idUsuario']); ?>" >
                           	<input class="btn btn-block btn-lg btn-primary" type="submit" value="ADICIONAR <?php echo(strtoupper($dalUsuario->primeiroNome($dados['nome']))); ?>" name="adicionarAmigo" />
                        </div>
                    </div>
                   </form>
                </div>
				   <?php } ?>
                <hr>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-20 mx-auto">
                                <div class="jumbotron">
                                    <div class="row text-center">
                                        <div class="text-center col-12">
                                            <table class="table table-striped">
    <?php
    $dalComentario = new DALComentario($conexao);
    $resultadoComentario = $dalComentario->localizarComentariosUsuario($idUsuario);
    $contador = 0;
    while ($dadosComentario = mysqli_fetch_array($resultadoComentario))
            {
        ?>
                                                    <tr>
                                                        <th><h3><?php echo($dadosComentario['nomeUsuario']); ?></h3>
															<input hidden="" type="text" name="idComentario" value="<?php echo($dadosComentario['idComentario']); ?>" >
															<input hidden="" type="text" name="responderMensagem" value="true" >
                                                            <p><?php echo($dadosComentario['comentario']); ?></p></th>
                                                    </tr>  
        <?php
        for ($i = 1; $i < 4; $i++) {
            if (isset($dadosComentario['resposta' . $i]) && $dadosComentario['resposta' . $i] != null && $dadosComentario['resposta' . $i] != "") {
                ?>
                                                            <tr>
                                                                <td><?php echo($dadosComentario['resposta' . $i]); ?></td>
                                                            </tr>
            <?php } ?>
                                                    <?php } ?>
                                                    <?php
                                                    if ($_SESSION['usuarioId'] == $idUsuario) {
                                                        ?>
                                                        <form name="enviarResposta" action="#" target="_self" method="post">
                                                            <table class="table table-striped">
                                                                <tr>
                                                                <div class="text-center col-12">
                                                                    <h2>RESPONDER MENSAGEM</h2>
                                                                </div>
                                                                <div  class="text-center col-12">
                                                                    <!-- CONTACT FORM https://github.com/jonmbake/bootstrap3-contact-form -->

                                                                    <div class="form-group">
                                                                        <label for="name">Nome</label>
                                                                        <h4><?php echo($_SESSION['usuarioNome']); ?></h4>
                                                                        <input name="email" type="text" hidden="" value="<?php echo($_SESSION['usuarioNome']); ?>">
                                                                        <input name="idDestinatario" type="text" hidden="" value="<?php echo($idUsuario); ?>">
                                                                        <span id="nameHelp" class="form-text text-muted" style="display: none;">Please enter your name.</span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">E-Mail</label>
                                                                        <h4><?php echo($_SESSION['usuarioEmail']); ?></h4>
                                                                        <input name="email" type="email" hidden="" value="<?php echo($_SESSION['usuarioEmail']); ?>">
                                                                        <span id="emailHelp" class="form-text text-muted" style="display: none;">Please enter a valid e-mail address.</span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="message">Resposta</label>
                                                                        <textarea rows="10" cols="100" class="form-control text-center" id="message" name="message" aria-describedby="messageHelp"></textarea>
                                                                        <span id="messageHelp" class="form-text text-muted" style="display: none;">Please enter a message.</span>
                                                                    </div>
                                                                    <input class="btn btn-block btn-lg btn-primary" type="submit" value="Responder" name="responderMensagem" />
                                                                    <a class="btn btn-block btn-lg btn-danger" href="deletarComentario.php?idComentario =<?php echo $dadosComentario['idComentario'];?>&idUsuario = <?php echo $_SESSION['usuarioId'];?>">Deletar Comentário</a>

                                                                </div>
                                                                </tr>
                                                            </table>
                                                        </form>
        <?php
        }
    }
    if ($_SESSION['usuarioId'] != $idUsuario) {
        ?>
                                                    <form name="enviarResposta" action="#" target="_self" method="post">
                                                        <table class="table table-striped">
                                                            <tr>
                                                            <div class="text-center col-12">
                                                                <h2>ENVIAR MENSAGEM</h2>
                                                            </div>
                                                            <div  class="text-center col-12">
                                                                <!-- CONTACT FORM https://github.com/jonmbake/bootstrap3-contact-form -->

                                                                <div class="form-group">
                                                                    <label for="name">Nome</label>
                                                                    <h4><?php echo($_SESSION['usuarioNome']); ?></h4>
                                                                    <input name="email" type="text" hidden="" value="<?php echo($_SESSION['usuarioNome']); ?>">
                                                                    <input name="idDestinatario" type="text" hidden="" value="<?php $idDestinatario = 1;
                                            echo($idUsuario);
                                            ?>">
                                                                    <span id="nameHelp" class="form-text text-muted" style="display: none;">Please enter your name.</span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">E-Mail</label>
                                                                    <h4><?php echo($_SESSION['usuarioEmail']); ?></h4>
                                                                    <input name="email" type="email" hidden="" value="<?php echo($_SESSION['usuarioEmail']); ?>">
                                                                    <span id="emailHelp" class="form-text text-muted" style="display: none;">Please enter a valid e-mail address.</span>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="message">Mensagem</label>
                                                                    <textarea rows="10" cols="100" class="form-control text-center" id="message" name="message" aria-describedby="messageHelp"></textarea>
                                                                    <span id="messageHelp" class="form-text text-muted" style="display: none;">Please enter a message.</span>
                                                                </div>
                                                                <input class="btn btn-block btn-lg btn-primary" type="submit" value="Enviar" name="enviarMensagem" />

                                                            </div>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                <?php } ?>
                                        </div>
                                        <br>
                                    </div>
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