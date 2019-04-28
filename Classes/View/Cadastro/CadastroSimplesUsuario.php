<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>a
<?php
$conexao = new Conexao();

$dalUsuario = new DALUsuario($conexao);

$validacao = new Validacao();

if (isset($_POST['deslogar'])) {
    $logof = $validacao->Deslogar();
    if (!$logof) {
        echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
		<script type= \"text/javascript\">
		alert(\"seja bem vindo {$resultado['nome']} .\");
		</script>";
    } else {
        echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
		<script type= \"text/javascript\">
		alert(\"Erro ao logar. Por favor verifique login e senha, tente novamente 2.\");
		</script>";
    }
}
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] != null) {
    $nome = trim($_POST['nome']);

//TRATAMENTO CPF
    $cpf = trim($_POST['cpf']);
    $cpf = $dalUsuario->tratarCaracteres($cpf);

    $dataNascimento = trim($_POST['dataNascimento']);
    $dataCadastro = date('Y-m-d');
    $sexo = trim($_POST['sexo']);
    $email = trim($_POST['email']);
    $nivelAcesso = trim($_POST['nivelAcesso']);

//TRATAMENTO DDD
    $ddd = trim($_POST['ddd']);
    $ddd = $dalUsuario->tratarCaracteres($ddd);

//TRATAMENTO TELEFONE
    $telefone = trim($_POST['telefone']);
    $telefone = $dalUsuario->tratarCaracteres($telefone);

    $senha = trim($_POST['senha']);
    $confirmarSenha = trim($_POST['confirmarSenha']);
    $imagem = trim($_FILES['imagem']['name']);
    $temp = trim($_FILES['imagem']['tmp_name']);
    $size = trim($_FILES['imagem']['size']);

    $usuario = new Usuario(1, $nome, $cpf, $dataNascimento, $dataCadastro, $email, $senha, $nivelAcesso, $ddd, $telefone, $sexo, $imagem);
    //print_r($usuario);
    
    //TESTE DE VARIAVEIS
    echo($nome);

    if ($size > 1 || $size < 4001) {
        if ($_POST['senha'] == $_POST['confirmarSenha']) {
            $cx = new Conexao();
            $dalUsuario = new DALUsuario($cx);

            $usuario = new Usuario(1, $nome, $cpf, $dataNascimento, $dataCadastro, $email, $senha, $nivelAcesso, $ddd, $telefone, $sexo, $imagem);
            
            move_uploaded_file($temp, "../../../imagens/".$imagem);

            //print_r($pessoa);
            //print_r($size);
            //header("Location: CadastroUsuario.php");

            print_r($usuario);

            $cadastroOK = $dalUsuario->inserirUsuario($usuario);

            if ($cadastroOK) {
                echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
					<script type= \"text/javascript\">
					alert(\"O usuário $nome foi cadastrado com sucesso\");
					</script>";
            }//CADASTRO USUARIO OK
            else {
                echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=#'>
					<script type= \"text/javascript\">
					alert(\"Erro ao cadastrar usuário. Tente novamente\");
					</script>";
            }//CADASTRO USUARIO OK
        }//TAMANHO
        else {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=#'>
				<script type= \"text/javascript\">
				alert(\"Erro ao cadastrar usuário. Por favor verifique as senhas e tente novamente\");
				</script>";
        }//SENHAS IGAUS
    }//TAMANHO
    else {
        echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=#'>
			<script type= \"text/javascript\">
			alert(\"Erro ao cadastrar o produto. O tamanho do arquivo deve ter até 15MB\");
			</script>";
    }//TAMANHO
}//CAMPOS OBRIGATÓRIOS
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bo <?php echo($_SESSION['usuarioSexo']); ?></title>
        <!-- Bootstrap -->
        <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet" type="text/css"/>
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
                            if (isset($_SESSION['usuarioNome']) && $_SESSION['usuarioNome'] != null) {
                                ?>
                                <img class="rounded-circle" src='<?php echo "../../../imagens/".$_SESSION['usuarioImagem']; ?>' alt="foto de perfil" width="36" height="33" id="imagem" title="foto de perfil" />
                                <?php
                                $conexao = new Conexao();
                                $dalUsuario = new DALUsuario($conexao);
                                echo($dalUsuario->primeiroNome($_SESSION['usuarioNome']));
                                ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <table>
                                    <tr>
                                        <td><a class="dropdown-item" href='../Alterar/AlterarUsuarioCompra.php?idPessoa=<?php echo $_SESSION['usuarioId']; ?>'><img title="alterar informações do usuario" class="rounded-circle" src="../../../images/124654893.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Alterar informações</a>
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
                <form name="formBuscar" class="form-inline my-2 my-lg-0" action="../Busca/ResultadoBusca.php" target="_self" method="post">
                      <div class="btn border-0"><input required="" name="buscar" class='btn btn border-0 text-center font-weight-bold' size="19" type="search" aria-label="Search"><!--<input name="procurar" class='align-baseline' type="image" id="procurar" title="Procurar" src="images/musica-searcher.png" alt="procurar" width="25" height="28" />-->
                        <button class='btn border-0 text-center font-weight-bold' >
                            <img src="../../../images/musica-searcher.png" width="25" height="28" /></button></div>
                </form>
            </div>
        </nav>
        <div class="jumbotron">
            <!-- INICIO SLIDES -->
            <div class="container">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-12">
                            <hr>
                            <h2 class="text-center">CADASTRO DE USUÁRIO</h2>
                            <hr>
                            <form name="form_email" action="#" target="_self" method="post" enctype="multipart/form-data">
                                <div class="container" align="center">
                                    <table class="form_menu2" align="center">
                                        <tr>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="nome"><img title="nome de usuário" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="nome" type="text" required="required" id="nome" placeholder="Informe o seu nome completo" title="Nome" size="25" maxlength=50">&nbsp;</td>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="dataNascimento"><img title="dataNascimento" class="rounded-circle" src="../../../images/61469.svg" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="dataNascimento" type="date" required="required" id="dataNascimento" placeholder="Informe o seu email (obrigatório)" title="data de nascimento" size="25 maxlength=50">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><p>&nbsp;</p></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="sexo"><img title="sexo" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label></inpu>&nbsp;
                                                <input class='btn btn-group border-0 text-center font-weight-bold' name="sexo" type="radio" id="sexo" title="Sexo masculino" value="F"><h5 class='btn btn-group border-0 text-center font-weight-bold'>
                                                    Feminino</h5>
                                                <input class='btn btn-group border-0 text-center font-weight-bold' name="sexo" type="radio" id="sexo" title="Sexo Feminino" value="M">
                                                <h5 class='btn btn-group border-0 text-center font-weight-bold'>Masculino</h5></td>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="email"><img title="Email" class="rounded-circle" src="../../../images/email3.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="email" type="email" required="required" id="email" placeholder="Informe o seu email" title="email" size="25" maxlength=50">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><p>&nbsp;</p></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="ddd"><img title="ddd" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="ddd" type="text" required="required" id="ddd" placeholder="Informe o DDD" title="DDD" size="10" maxlength=50">&nbsp;
                                            </td>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="telefone"><img title="telefone" class="rounded-circle" src="../../../images/icon_phone2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="telefone" type="text" required="required" id="telefone" placeholder="Informe o seu telefone, somente os números" title="Telefone" size="25" maxlength=50">&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><p>&nbsp;</p></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><label for="nivelAcesso"><font class="font-weight-bold" color="#ff0000">*</font>
                                                    <img title="nivelAcesso" class="rounded-circle" src="../../../images/1246548.png" width="35" height="37" /></label>&nbsp;
                                                <select class='btn btn-group border-0 text-center font-weight-bold' name="nivelAcesso" id="nivelAcesso" title="Nivel de acesso" type="text">
                                                    <option class='btn btn-group border-0 text-center font-weight-bold' value="">Escolha uma opção</option>
                                                    <option class='btn btn-group border-0 text-center font-weight-bold' value="PACIENTE">Paciente</option>
                                                    <option class='btn btn-group border-0 text-center font-weight-bold' value="MEDICO">Médico</option>
                                                </select>&nbsp;
                                            </td>
                                            <td align="center"><label for="email"><font class="font-weight-bold" color="#ff0000">*</font>
                                                    <img title="Email" class="rounded-circle" src="../../../images/email3.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="cpf" type=text" required="required" id="email" placeholder="Informe o documento" title="email" size="25" maxlength="50">&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><p>&nbsp;</p></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="senha"><img title="nome de usuário" class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="senha" type="password" required="required" id="senha" placeholder="Informe a senha" title="Senha" size="25" maxlength=50">&nbsp;
                                            </td>
                                            <td align="center"><font class="font-weight-bold" color="#ff0000">*</font>
                                                <label for="confirmarSenha"><img title="nome de usuário" class="rounded-circle" src="../../../images/lock2.png" width="35" height="37" /></label>&nbsp;<input class='btn btn-group border-0 text-center font-weight-bold' name="confirmarSenha" type="password" required="required" id="confirmarSenha" placeholder="Informe a senha" title="Senha" size="25" maxlength=50">&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><p>&nbsp;</p></td>
                                        </tr>
                                    </table>
                                    <table class="form_menu2" align="center">
                                        <tr>
                                            <td align="center"><h5><label for="imagem">Selecionar imagem:</br><font color="#ff0000"> Tamanho máximo 4MB</font></label></h5>
                                                <blockquote>
                                                    <input name="imagem" type="file" id="imagem" title="imagem" size="30" maxlength=50">
                                                </blockquote>
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <br>
                                    <input class="btn btn-block btn-lg btn-primary" type="submit" value="Cadastrar" name="cadastrar" />
                            <!--<p align="right"><a href="#" class="btn btn-primary">Cadastrar</a></p>-->
                                    </blockquote>
                                    </tr>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="../../../js/jquery-3.2.1.min.js"></script> 
        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="../../../js/popper.min.js"></script> 
        <script src="../../../js/bootstrap-4.0.0.js"></script>
    </body>
</footer>
</body>
</html>
