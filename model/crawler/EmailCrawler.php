<?php

class EmailCrawler
{
	
	private $urlDao;
	
	private $emailDao;
	
	private $mostrarMensagens;

	public function __construct(EmailDAO $emailDao, UrlDAO $urlDao, $mostrarMensagens) 
	{
		$this->urlDao = $urlDao;
		$this->emailDao = $emailDao;
		$this->mostrarMensagens=$mostrarMensagens;	
	}
	
	public function rastrearEmails()
	{
		$temNovasUrl = false;
	
		$url = $this->urlDao->obterUrlNaoVisitada();
		//se tiver URL
		if($url)
		{
			$temNovasUrl = true;
			$this->mostrarMensagem("Rastreando URL da base:{$url->getUrl()}\n");
			
				
			//obtem o conteudo da URL
			$conteudo = file_get_contents($url->getUrl());
				
			//se conseguir acessar a URL
			if($conteudo)
			{
				$this->buscarNovasUrlsAdicionarNaBase($conteudo);
		
				$this->buscarEmailsAdicionarNaBase($conteudo);
			}
			else 
			{
				$this->mostrarMensagem("	**** URL invalida ou nao acessivel ****\n");
			}
				
			$this->urlDao->marcarUrlComoVisitada($url->getId());
		}
	
		return $temNovasUrl;
	}
	
	private function buscarNovasUrlsAdicionarNaBase($conteudo)
	{
		//procura URL no HTML
		$encontrouUrls = preg_match_all('/<a href=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?>/i', $conteudo, $resultados);
		
		//se encontrar URLS
		if($encontrouUrls)
		{
			foreach($resultados[1] as $urlEncontradas)
			{
				$this->mostrarMensagem("	URL:{$urlEncontradas} adicionando na base...");
				
				//adiciona na base
				if($this->urlDao->adicionarUrlSeNaoExistir($urlEncontradas)) 
				{
					$this->mostrarMensagem("Ok!\n");
				}
				else 
				{
					$this->mostrarMensagem("ERRO!\n");
				}
			}
		}
	}
	
	private function buscarEmailsAdicionarNaBase($conteudo)
	{
		$encontrouEmails = preg_match_all('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $conteudo, $resultados);
		
		//se encontrar emails
		if($encontrouEmails)
		{
			$this->mostrarMensagem("	".$encontrouEmails." email(s) encontrado(s)\n");
			
			foreach($resultados as $emailEncontrado)
			{
				foreach ($emailEncontrado as $emailValido)
				{
					$this->mostrarMensagem("	Email:{$emailValido} adicionando na base...");
					//adiciona email na base
					if($this->emailDao->adicionarEmailSeNaoExistir($emailValido))
					{
						$this->mostrarMensagem("Ok!\n");
					}
					else 
					{
						$this->mostrarMensagem("ERRO!\n");
					}
				}
			}
		}
	}
	
	private function mostrarMensagem($mensagem)
	{
		if($this->mostrarMensagens) echo $mensagem;
	}
	
}

?>