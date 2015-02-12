<?php
/**
 * Classe de acesso às URL´s cadastradas na base de dados
 */
interface UrlDAO 
{

	/**
	 * Retorna um objeto do 
	 */
	public function obterUrlNaoVisitada();
	
	public function adicionarUrlSeNaoExistir($url);
	
	public function marcarUrlComoVisitada($id);
}


?>