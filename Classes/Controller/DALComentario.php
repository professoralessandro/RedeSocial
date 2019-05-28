<?php include_once("../Conexao/Conexao.php"); ?>
<?php include_once("../Model/Comentario.php"); ?>
<?php

class DALComentario {

    //Propriedades
    private $conexao;

    //Construtor
    public function __construct($conexao) {
        $this->conexao = $conexao;
        //$this->conexao = new Conexao();
    }

    //METODOS
    public function inserirComentario($comentario) {
        $sqlComand = "insert into tbComentario(TbUsuario_idUsuario, idUsuario, nomeUsuario)values('";
        $sqlComand = $sqlComand . $comentario->getIdDestinatario() . "','";
        $sqlComand = $sqlComand . $comentario->getIdPessoa() . "','";
        $sqlComand = $sqlComand . $comentario->get . "','";
        $sqlComand = $sqlComand . $comentario->getEmailUsuario() . "','";
        $sqlComand = $sqlComand . $comentario->getDataHora() . "','";
        $sqlComand = $sqlComand . $comentario->getComentario() . "')";

        $banco = $this->conexao->GetBanco();
        $banco->query($sqlComand);
        $this->conexao->Desconectar();
    }

//INSERIR

    public function comentar($comentario) {
        //$comentario = new Comentario();

        $sqlComand = "insert into tbComentario(TbUsuario_idUsuario, idUsuario, nomeUsuario, emailUsuario, dataHora, comentario)values('";
        $sqlComand = $sqlComand . $comentario->getIdDestinatario() . "','";
        $sqlComand = $sqlComand . $comentario->getIdPessoa() . "','";
        $sqlComand = $sqlComand . $comentario->getNomeUsuario() . "','";
        $sqlComand = $sqlComand . $comentario->getEmailUsuario() . "','";
        $sqlComand = $sqlComand . $comentario->getDataHora() . "','";
        $sqlComand = $sqlComand . $comentario->getComentario() . "')";

        $banco = $this->conexao->GetBanco();
        $banco->query($sqlComand);
        $this->conexao->Desconectar();
    }

//INSERIR

    public function alterarComentario($comentario) {
        $comentario = new Comentario();

        $sqlComand = "update tbComentario
		set nome = " . $comentario->getNome() .
                ", data = " . $comentario->getData() .
                ", isCompra = " . $comentario->getIsCompra() .
                " comentario = " . $comentario->getComentario() .
                " where idComentario = " . $comentario->getIdComentario()
        ;

        $banco = $this->conexao->GetBanco();
        $banco->query($sqlComand);
        $this->conexao->Desconectar();
    }
	
	//RESPONDER COMENTARIO
	public function responderComentario($DadosComentario, $resposta)
    {
		$ultimoComentario = 1;
		
		for($i = 1; $i < 4; $i++)
		{
			if(count($DadosComentario['resposta'.$i]) > 0)
			{
				$ultimoComentario ++;
			}
			else
			{
			}
		}
		
		if($ultimoComentario == 0)
		{
			$ultimoComentario ++;
		}
		else if($ultimoComentario == 0)
		{
			return false;
		}
		
        $sqlComand = "UPDATE tbComentario SET resposta". $ultimoComentario." = '".$resposta."' where idComentario = ".$DadosComentario['idComentario'];
		
        $banco = $this->conexao->GetBanco();
        $banco->query($sqlComand);
        $this->conexao->Desconectar();
    }
	//RESPONDER COMENTARIO

    public function excluirComentario($idComentario) {
        $sqlComand = "delete from tbComentario where idComentario = " . $idComentario;
        $banco = $this->conexao->GetBanco();
        $banco->query($sqlComand);
        $this->conexao->Desconectar();
    }

    public function localizarComentario($idComentario) {
        $sqlComand = "select * from tbComentario where idComentario = " . $idComentario;

        $banco = $this->conexao->GetBanco();
        $retorno = $banco->query($sqlComand);
        return $retorno;
        $this->conexao->Desconectar();
    }

    public function localizarComentariosUsuario($idUsuario) {
        
        $sqlComand = "select * from tbComentario where idUsuario = '" . $idUsuario . "'";

        $banco = $this->conexao->GetBanco();
        $retorno = $banco->query($sqlComand);
        return $retorno;
        $this->conexao->Desconectar();
    }

    public function listarComentario() {
        $sqlComand = " select * from tbComentario ";

        $banco = $this->conexao->GetBanco();
        $retorno = $banco->query($sqlComand);
        return $retorno;
        $this->conexao->Desconectar();
    }

}

//class
?>