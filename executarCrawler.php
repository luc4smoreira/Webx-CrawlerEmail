<?php

	require("controller/includes/inicializa.php");


	$urlDao = new UrlDaoImp($db);
	$emailDao = new EmailDAOImp($db);
	
	$crawler = new EmailCrawler($emailDao, $urlDao, true);

	while(true) 
	{
		$temUrl = $crawler->rastrearEmails();

		if(!$temUrl)
		{
			break;
		}
	}
	


	
?>