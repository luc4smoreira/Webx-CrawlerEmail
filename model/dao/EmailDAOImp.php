<?php
/**
 * Classe de acesso às URL´s cadastradas na base de dados
 */
class EmailDAOImp implements EmailDAO
{
	private $conexao;

	public function __construct(PDO $conexao_banco) {
        $this->conexao = $conexao_banco;
    }


	public function adicionarEmailSeNaoExistir($email)
	{
		$insercao = $this->conexao->prepare("INSERT INTO emails (email) SELECT * FROM (SELECT ?) AS tmp WHERE NOT EXISTS (SELECT email FROM emails WHERE email = ?) LIMIT 1");
		$insercao->bindParam(1, $email);
		$insercao->bindParam(2, $email);
		return $insercao->execute();
	}
	
	public function listar10UltimosEmailsCadastrados() 
	{
		$consulta = $this->conexao->query("SELECT email FROM emails ORDER BY id DESC LIMIT 10");
		
		$total = $consulta->rowCount();
		if($total > 0)
		{
			$emails = null;
			for($i=0; $i<$total; $i++)
			{
				$linha = $consulta->fetch(PDO::FETCH_OBJ);
				$emails[$i] = $linha->email;
			}	
		
		}
		
		return $emails;
	}
}


?>