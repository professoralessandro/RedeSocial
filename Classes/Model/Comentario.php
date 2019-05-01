<?php
class Comentario
{
	//ATRIBUTOS
	private $idComentario;
	private $idPessoa;
	private $idDestinatario;
	private $dataHora;
	private $emailUsuario;
	private $nomeUsuario;
        private $comentario;
	private $resposta1;
        private $resposta2;
        private $resposta3;

    //CONSTRUTOR
    public function __construct($idComentario ="", $idPessoa ="", $idDestinatario ="", $dataHora ="", $emailUsuario ="", $nomeUsuario ="", $comentario ="", $resposta1 ="", $resposta2 ="", $resposta3 ="") {
        $this->idComentario = $idComentario;
        $this->idPessoa = $idPessoa;
        $this->idDestinatario = $idDestinatario;
        $this->dataHora = $dataHora;
        $this->emailUsuario = $emailUsuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->comentario = $comentario;
        $this->resposta1 = $resposta1;
        $this->resposta2 = $resposta2;
        $this->resposta3 = $resposta3;
    }
    //CONSTRUTOR
    
    //PROPRIEDADES
    public function getIdComentario() {
        return $this->idComentario;
    }

    public function getIdPessoa() {
        return $this->idPessoa;
    }

    public function getIdDestinatario() {
        return $this->idDestinatario;
    }

    public function getDataHora() {
        return $this->dataHora;
    }

    public function getEmailUsuario() {
        return $this->emailUsuario;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function getResposta1() {
        return $this->resposta1;
    }

    public function getResposta2() {
        return $this->resposta2;
    }

    public function getResposta3() {
        return $this->resposta3;
    }

    public function setIdComentario($idComentario) {
        $this->idComentario = $idComentario;
    }

    public function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    public function setIdDestinatario($idDestinatario) {
        $this->idDestinatario = $idDestinatario;
    }

    public function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    public function setEmailUsuario($emailUsuario) {
        $this->emailUsuario = $emailUsuario;
    }

    public function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function setResposta1($resposta1) {
        $this->resposta1 = $resposta1;
    }

    public function setResposta2($resposta2) {
        $this->resposta2 = $resposta2;
    }

    public function setResposta3($resposta3) {
        $this->resposta3 = $resposta3;
    }

}//CLASS
?>