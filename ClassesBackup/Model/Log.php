<?php
class Log
{
	//ATRIBUTOS
	private $idLog;
	private $nome;
	private $dataHora;
	private $acao;
	private $comentLog;

	//CONSTRUTOR
	public function __construct($idLog ="",$nome ="", $dataHora ="", $acao ="", $comentLog ="")
	{

		$this->idLog = $idLog;
		$this->nome = $nome;
		$this->dataHora = $dataHora;
		$this->acao = $acao;
		$this->comentLog = $comentLog;
	}
}//CLASS
?>