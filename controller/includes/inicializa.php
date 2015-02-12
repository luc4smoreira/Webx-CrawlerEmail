<?php
	
	//echo "inicializando...\n";
	

	//Conecta com o banco
	$host = "localhost";
	$user= "root"; 
	$dataBase = "webx"; 
	$pass="brasil";
	
	//conecta ao banco
	$db = new PDO("mysql:host=localhost;dbname=".$dataBase, $user, $pass); 
	if(!$db)
	{
		die('Nao foi possivel conectar ao banco de dados. Tente novamente mais tarde.');
	}
	
	//limpa as varaveis do banco
	unset($host, $user, $pass, $dataBase);


	define('ROOT',"/webx/webx/"); //Caminho onde está a aplicação: Exemplo: http://localhost/webx/webx/view/carregarLista.php, então colocar:"/webx/webx/" 
	define('MODEL',"model/");
	define('DTO', "dto/");
	define('DAO', "dao/");

	if(isCommandLineInterface()) 
	{
		carregaClasse(MODEL."crawler/EmailCrawler.php", true);
		
		carregaClasse(MODEL."dto/UrlDTO.php", true);
		carregaClasse(MODEL."dao/UrlDAO.php", true);
		carregaClasse(MODEL."dao/UrlDAOImp.php", true);
		
		carregaClasse(MODEL."dao/EmailDAO.php", true);
		carregaClasse(MODEL."dao/EmailDAOImp.php", true);
		
	}



	function isCommandLineInterface()
	{
	    return (php_sapi_name() === 'cli');
	}

	//Faz AutoLoad das classes
	function __autoload($classe)
	{		
		$arquivoDTO = $_SERVER['DOCUMENT_ROOT'].ROOT.MODEL.DTO.$classe.".php";
		carregaClasse($arquivoDTO, false);
		
		$arquivoDAO = $_SERVER['DOCUMENT_ROOT'].ROOT.MODEL.DAO.$classe.".php";
		carregaClasse($arquivoDAO, false);
	}

	
	function carregaClasse($arquivo, $mostrarMensagem)
	{
		if($mostrarMensagem) echo "Carregando arquivo:{$arquivo}...";
		if(is_file($arquivo))
		{			
			require_once($arquivo);
			if($mostrarMensagem) echo "OK!\n";
		}
		else if($mostrarMensagem) echo "****** ERRO!\n";
	}



?>
