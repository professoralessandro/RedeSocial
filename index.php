<?php session_start(); ?>
<?php include_once("Classes/Conexao/Conexao.php"); ?>
<?php include_once("Classes/Model/Usuario.php"); ?>
<?php include_once("Classes/Controller/DALUsuario.php"); ?>
<?php include_once("Classes/Conexao/Validacao.php"); ?>
<?php
if (isset($_POST['email']) && isset($_POST['senha'])) {
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

if (empty($resultado))
    {
    echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=index.php'>
		<script type= \"text/javascript\">
		alert(\"Erro ao logar. Por favor verifique login e senha, tente novamente.\");
		</script>";
    }
    elseif (isset($resultado))
    {
        $usuario = new Usuario($resultado['idUsuario'], $resultado['nome'], '', $resultado['dataNascimento'], $resultado['dataCadastro'], $resultado['email'], $resultado['senha'], $resultado['nivelAcesso'], $resultado['ddd'], $resultado['telefone'], $resultado['sexo'], $resultado['imagem']);

        $login = $validacao->logar($usuario);
        if (!$login) {
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
else if (isset($_POST['deslogar']))
{
    echo("Esta aqui");

    $logof = $validacao->Deslogar();
    if (!$logof)
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="rounded-circle" src="images/logotipoMedBook.jpg" width="45" height="45" title="Logo tipo" />
    <?php
    if (isset($_SESSION['usuarioNome']) && $_SESSION['usuarioNome'] != null) {
    ?>
    <?php
        $conexao = new Conexao();
        $dalUsuario = new DALUsuario($conexao);
        echo($dalUsuario->primeiroNome($_SESSION['usuarioNome']));
        ?>
        <?php
    } else {
        ?>
        <?php echo("Madbook"); ?>
    <?php } ?>
        </div>
</nav>


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
                                    <h5><font color="#3b5998">Uma profissão que cuida de vidas</h5>
                                    <p><strong>Medicina também é amor ao próximo</strong></font></p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="images/medicina-uma-profissao3.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><font color="#3b5998">A síndrome de Down não é uma doença!</h5>
                                    <p><strong>Mas a bem da verdade, exige alguns cuidados com a saúde</strong></font></p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 img-fluid" src="images/medicina-uma-profissao2.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><font color="#3b5998">Uma rede social que ajuda você</h5>
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
                        <!-- <form name="formCadastroUsuario" action="#" target="_self" method="post" enctype="multipart/form-data">  -->
                    <?php
                    if (isset($_SESSION['usuarioNome'])) { //header('Location:Classes/View/Loja/ConfirmarCompra.php');
                        echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=Classes/View/Usuario/home.php'>";
                        ?>
                    <?php
                    } else {
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
                                                    <li class="pull-left"><a href="Classes/View/Cadastro/CadastroSimplesUsuario.php">Você não tem conta ?</a></li>
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
    </body>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
