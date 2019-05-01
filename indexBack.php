<!DOCTYPE html>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Medbook</a>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <table>
            <tr>
                <td>a<img title="alterar informações do usuario" class="rounded-circle" src="images/124654893.png" width="35" height="37" />&nbsp;&nbsp;&nbsp;Alterar informações</a>
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
                        <!--<form name="formCadastroUsuario" action="#" target="_self" method="post" enctype="multipart/form-data"> -->
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