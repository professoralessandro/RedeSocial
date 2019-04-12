<?php session_start(); ?>
<?php
unset(
	$_SESSION['usuarioId'],
	$_SESSION['usuarioNome'],
	$_SESSION['usuarioNascimento'],
	$_SESSION['usuarioCadastro'],
	$_SESSION['usuarioEmail'],
	$_SESSION['usuarioAcessoNiveis'],
	$_SESSION['usuarioTelDDD'],
	$_SESSION['usuarioTelefone'],
	$_SESSION['usuarioSexo'],
	$_SESSION['usuarioImagem']
	);
		
	echo "<META HTTP-EQUIV=REFRESH CONTENT ='0;URL=../../index.php'>
	<script type= \"text/javascript\">
	alert(\"A sessão foi encerrada com sucesso.\");
	</script>";
?>