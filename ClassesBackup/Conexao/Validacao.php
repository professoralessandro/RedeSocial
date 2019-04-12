<?php session_start(); ?>
<?php include_once("../Model/Usuario.php"); ?>
<?php
class Validacao
{
	public function logar($usuario)
	{
		$_SESSION['usuarioId'] = $usuario->getIdUsuario();
		$_SESSION['usuarioNome'] = $usuario->getNome();
		$_SESSION['usuarioNascimento'] = $usuario->getDataNascimento();
		$_SESSION['usuarioCadastro'] = $usuario->getDataCadastro();
		$_SESSION['usuarioEmail'] = $usuario->getEmail();
		$_SESSION['usuarioAcessoNiveis'] = $usuario->getNivelAcesso();
		$_SESSION['usuarioTelDDD'] = $usuario->getDdd();
		$_SESSION['usuarioTelefone'] = $usuario->getTelefone();
		$_SESSION['usuarioSexo'] = $usuario->getSexo();
		$_SESSION['usuarioImagem'] = $usuario->getImagem();
	}//LOGAR
	
	public function Deslogar()
	{
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
	}
}//CLASS
?>