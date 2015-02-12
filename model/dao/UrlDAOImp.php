<?php
/**
 * Classe de acesso às URL´s cadastradas na base de dados
 */
class UrlDAOImp implements UrlDAO
{
	private $conexao;

	public function __construct(PDO $conexao_banco) {
        $this->conexao = $conexao_banco;
    }

	public function obterUrlNaoVisitada() 
	{
		$url = false;
		$consulta = $this->conexao->query("SELECT id, url, visited FROM urls WHERE visited='no' LIMIT 1");
		
		if($consulta->rowCount() > 0)
		{
			$url = new UrlDTO();
			$linha = $consulta->fetch(PDO::FETCH_OBJ);

			$url->setId($linha->id);
			$url->setUrl($linha->url);
			$url->setVisited($linha->visited);

		}
		
		return $url;	
	}
	
	public function adicionarUrlSeNaoExistir($url) 
	{
		$insercao = $this->conexao->prepare("INSERT INTO urls (url) SELECT * FROM (SELECT ?) AS tmp WHERE NOT EXISTS (SELECT url FROM urls WHERE url = ?) LIMIT 1");
		$insercao->bindParam(1, $url);
		$insercao->bindParam(2, $url);
		return $insercao->execute();
	}
	
	public function marcarUrlComoVisitada($id)
	{
		$consulta = $this->conexao->prepare("UPDATE urls SET visited='yes' WHERE id = ?");
		$consulta->bindParam(1, $id);
		return $consulta->execute();
	}
}


?>