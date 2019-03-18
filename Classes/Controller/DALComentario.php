<?php include_once("../Conexao/Conexao.php"); ?>
<?php include_once("../Model/Comentario.php"); ?>
<?php
class DALComentario
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
	public function inserirComentario($comentario)
	{
		$sqlComand = "insert into tbComentario (idPessoa, idProduto, nome, data, comentario) values('";
		$sqlComand = $sqlComand . $comentario->getIdPessoa() . "','";
		$sqlComand = $sqlComand . $comentario->getIdProduto() . "','";
		$sqlComand = $sqlComand . $comentario->getNome() . "','";
		$sqlComand = $sqlComand . $comentario->getData() . "','";
		$sqlComand = $sqlComand . $comentario->getComentario() . "')";
		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
	}//INSERIR
	
	public function alterarComentario($comentario)
	{
		$comentario = new Comentario();
		
		$sqlComand = "update tbComentario
		set nome = ". $comentario->getNome() .
		", data = ". $comentario->getData() .
		", isCompra = ". $comentario->getIsCompra() .
		" comentario = ". $comentario->getComentario() .
		" where idComentario = ". $comentario->getIdComentario()
		;
		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
	}
	
	public function excluirComentario($idComentario)
	{
		$sqlComand = "delete from tbComentario where idComentario = ". $idComentario ;		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
	}
	
	public function localizarComentario($idComentario)
	{
		$sqlComand = "select * from tbComentario where idComentario = ". $idComentario;
		
		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
	}
	
	public function localizarComentarioProduto($idProduto)
	{
		$sqlComand = "select * from tbComentario where idProduto = ". $idProduto;
		
		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
	}
	
	public function listarComentario()
	{
		$sqlComand = " select * from tbComentario ";
		
		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
	}
}//class
?>