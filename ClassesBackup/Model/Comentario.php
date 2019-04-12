<?php
class Comentario
{
	//ATRIBUTOS
	private $idComentario;
	private $idPessoa;
	private $idProduto;
	private $isCompra;
	private $nome;
	private $data;
	private $comentario;

	//CONSTRUTOR
	public function __construct($idComentario ="", $idPessoa ="", $idProduto ="", $isCompra ="", $nome ="", $data ="", $comentario ="")
	{
		$this->idComentario = $idComentario;
		$this->idPessoa = $idPessoa;
		$this->idProduto = $idProduto;
		$this->isCompra = $isCompra;
		$this->nome = $nome;
		$this->data = $data;
		$this->comentario = $comentario;
	}
	//CONSTRUTOR
}//CLASS
?>