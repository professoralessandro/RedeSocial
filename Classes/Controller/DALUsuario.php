<?php include_once("../Conexao/Conexao.php"); ?>
<?php include_once("../Model/Usuario.php"); ?>
<?php
class DALUsuario 
{
	//Propriedades
	private $conexao;
	
	//Construtor
	public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    //METODOS GET E SET
    
	//METODOS
    public function inserirUsuario($usuario)
    {
        $sqlComand = "insert into tbUsuario(nome, dataNascimento, dataCadastro, email, senha, nivelAcesso, ddd, telefone, sexo, imagem) values('";
		
		$sqlComand = $sqlComand . $usuario->getNome() . "','";
        $sqlComand = $sqlComand . $usuario->getDataNascimento() . "','";
        $sqlComand = $sqlComand . $usuario->getDataCadastro() . "','";
        $sqlComand = $sqlComand . $usuario->getEmail() . "','";
        $sqlComand = $sqlComand . $usuario->getSenha() . "','";
        $sqlComand = $sqlComand . $usuario->getNivelAceso . "','";
        $sqlComand = $sqlComand . $usuario->getDdd() . "','";
        $sqlComand = $sqlComand . $usuario->getTelefone() . "','";
		$sqlComand = $sqlComand . $usuario->getSexo() . "','";
		$sqlComand = $sqlComand . $usuario->getImagem() . "')";

		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
    }//INSERIR
	
    public function alterarUsuario($usuario)
    {
		$sqlComand = "update tbUsuario set nome = ". $usuario->getNome() .
		", dataNascimento = ". $usuario->getDataNascimento() .
		", email = ". $usuario->getEmail() .
		", senha = ". $usuario->getSenha() .
		", nivelAcesso = ". $usuario->getNivelAcesso .
		", ddd = ". $usuario->getDdd() .
		", telefone = ". $usuario->getTelefone() .
		", sexo = ". $usuario->getSexo() .
		" imagem = ". $usuario->getImagem() .
		" where idUsuario = ". $usuario->getId()
		;

		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
    }
	
    public function excluirUsuario($id)
    {
		$sqlComand = "delete from tbUsuario where idUsuario = ". $id ;		
		$banco = $this->conexao->GetBanco();
		$banco->query($sqlComand);
		$this->conexao->Desconectar();
    }
	
    public function localizarUsuario($id)
    {
		$sqlComand = "select * from tbUsuario where idUsuario = ". $id ;

		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
	}
	
	public function altenticarUsuario($email, $senha)
    {
		$sqlComand = "select * from tbUsuario where email = '".$email."' and senha = '".$senha."' ";

		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
	}
	
    public function listarUsuario()
    {
		$sqlComand = " select * from tbUsuario ";

		$banco = $this->conexao->GetBanco();
		$retorno = $banco->query($sqlComand);
		return $retorno;
		$this->conexao->Desconectar();
    }
	
	//FUNÇÃO  PRIMEIRO NOME
	public function primeiroNome($str)
	{
		$pos_espaco = strpos($str, ' ');// perceba que há um espaço aqui
		$primeiro_nome = substr($str, 0, $pos_espaco);
		$resto_nome = substr($str, $pos_espaco, strlen($str));

		return $primeiro_nome;
		//return array('primeiro_nome'=> $primeiro_nome, 'resto_nome' => $resto_nome);
	}
	
	//FUNÇÃO TRATAR DDD
    function buscarCaracteres($ddd)
    {
	$source = array('(', ')', ' ', '-', '.');
	$replace = array('', '');
	$valor = str_replace($source, $replace, $ddd); //remove os pontos e substitui a virgula pelo ponto
	return $valor; //retorna o valor formatado para gravar no banco
    }
    //FIM DA FUNÇÃO
}//class
?>