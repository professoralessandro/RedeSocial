<?php include_once("../Conexao/Conexao.php"); ?>
<?php include_once("../Model/Usuario.php"); ?>
<?php
class DALLog
{
	//Propriedades
	private $conexao;
	
	//Construtor
	public function __construct($conexao)
    {
        $this->conexao = $conexao;
		//$this->conexao = new Conexao();
    }
	
	//METODOS
	public function inserirLog($log)
	{
		$sqlComand = "insert into tbLog(nome, dataHora, acao, comentLog) values('";
		$sqlComand = $sqlComand . $log->getNome() . "','";
		$sqlComand = $sqlComand . $log->getDataHora() . "','";
		$sqlComand = $sqlComand . $log->getAcao() . "','";
		$sqlComand = $sqlComand . $log->getComentLog() . "')";
		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		//$this->conexao->Desconectar();
	}//INSERIR
	
	public function alterarLog($log)
	{
		$sqlComand = "update tbLog set nome = ". $usuario->getNome() .
		", email = ". $usuario->getDataHora() .
		", email = ". $usuario->getAcao() .
		" senha = ". $usuario->getComentLog() .
		" where id = ". $usuario->getIdLog()
		;
		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		//$this->conexao->Desconectar();
	}
	
	public function excluirLog($idLog)
	{
		$sqlComand = "delete from tbLog where idLog = ". $idLog ;		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		//$this->conexao->Desconectar();
	}
	
	public function localizarLog($idLog)
	{
		$sqlComand = "select * from tbLog where id = ". $idLog ;
		
		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		//$this->conexao->Desconectar();
	}
	
	public function listarLog()
	{
		$sqlComand = " select * from tbLog ";
		
		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		//$this->conexao->Desconectar();
	}
	
}//class
?>