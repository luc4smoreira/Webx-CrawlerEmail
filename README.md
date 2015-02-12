# Webx-CrawlerEmail
Projeto para webx - crawler de email 
Desenvolvido por Lucas Moreira Carneiro de Miranda

Primeiro passo
---------------------------------------------------------------
Alterar no arquivo /controller/includes/inicializa.php os dados de conexão com o banco 

$host = "localhost"; 
$user= "root"; 
$dataBase = "webx"; 
$pass="senha";

Para executar o Crawler pelo console:
-----------------------------------------------------------------
Após configurar o banco de dados. Acessar o diretório do projeto e executar o comando:
php executarCrawler.php 

Para acessar a interface web:
-----------------------------------------------------------------
1) Configurar o caminho onde se encontra a aplicação dentro do servidor na variável ROOT 
define('ROOT',"/webx/webx/"); //exemplo caso esteja em http://localhost/webx/webx/view/index.php

2) Acessar o arquivo index.php. Exemplo: http://localhost/webx/webx/view/index.php
