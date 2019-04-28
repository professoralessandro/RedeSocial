<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Model/Comentario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Controller/DALComentario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>
<?php 

/*
$idUsuario = trim(filter_input(INPUT_GET, 'idUsuario', FILTER_SANITIZE_NUMBER_INT));
$idComentario = trim(filter_input(INPUT_GET, 'idComentario', FILTER_SANITIZE_NUMBER_INT));
$idComentario = 1;
echo($idUsuario);

if($idUsuario == $_SESSION['usuarioId'])
{*/
    $conexao = new Conexao($conexao);
    $deletar = $dalComentario = new DALComentario($conexao);
    
    $deletar = $dalComentario->excluirComentario($idComentario);
    
    if(!$deletar)
    {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"O comentário foi deletado com sucesso.\");
            </script>";
    } else {
            echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=http://localhost/Classes/View/Usuario/home.php'>
            <script type= \"text/javascript\">
            alert(\"Erro ao deletar o comentário Tente novamente.\");
            </script>";
    }
/*
} else {
    echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=../../../index.php'>
    <script type= \"text/javascript\">
    alert(\"você não tem autorização para acessar a esta página.\");
    </script>";
}
?>*/