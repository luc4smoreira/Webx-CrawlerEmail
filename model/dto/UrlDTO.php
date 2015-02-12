<?php
/**
 * Classe Data Transfer Object que representa uma URL e seus dados.
 */
class UrlDTO 
{

	private $id;
	private $url;
	private $visited;
	
	public function getId() 
	{
		return $this->id;
	}

	public function setId($valor) 
	{
		$this->id = $valor;
	}
	
	public function getUrl() 
	{
		return $this->url;
	}

	public function setUrl($valor)
	{
		$this->url = $valor;
	}
	
	public function getVisited()
	{
		return $this->visited;
	}

	public function setVisited($valor) 
	{
		$this->visited = $valor;
	}
}


?>