<?php
class Usuario
{
    //ATRIBUTOS
    private $idUsuario;
    private $nome;
    private $documento;
    private $dataNascimento;
    private $dataCadastro;
    private $email;
    private $senha;
    private $nivelAcesso;
    private $ddd;
    private $telefone;
    private $sexo;
    private $imagem;
    //ATRIBUTOS
        
    //CONSTRUTORES
    
    
    public function __construct($idUsuario = "", $nome = "", $documento = "", $dataNascimento = "", $dataCadastro = "", $email = "", $senha = "", $nivelAcesso = "", $ddd = "", $telefone = "", $sexo = "", $imagem = "")
    {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->documento = $documento;
        $this->dataNascimento = $dataNascimento;
        $this->dataCadastro = $dataCadastro;
        $this->email = $email;
        $this->senha = $senha;
        $this->nivelAcesso = $nivelAcesso;
        $this->ddd = $ddd;
        $this->telefone = $telefone;
        $this->sexo = $sexo;
        $this->imagem = $imagem;
    }
    //CONSTRUTORES
    
    //PROPRIEDASDES
    
    public function getDocumento() {
        return $this->documento;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }
        
    public function getIdUsuario() {
        return $this->idUsuario;
    }
	
    public function getNome() {
        return $this->nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNivelAcesso() {
        return $this->nivelAcesso;
    }

    public function getDdd() {
        return $this->ddd;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getImagem() {
        return $this->imagem;
    }

	public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
	
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setNivelAcesso($nivelAcesso) {
        $this->nivelAcesso = $nivelAcesso;
    }

    public function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }
    //PROPRIEDADES
}//CLASS

?>