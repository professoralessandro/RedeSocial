<?php session_start(); ?>
<?php include_once("../../Conexao/Conexao.php"); ?>
<?php include_once("../../Model/Usuario.php"); ?>
<?php include_once("../../Model/Comentario.php"); ?>
<?php include_once("../../Controller/DALUsuario.php"); ?>
<?php include_once("../../Controller/DALComentario.php"); ?>
<?php include_once("../../Conexao/Validacao.php"); ?>
<?php 

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
