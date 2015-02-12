<?php require("../controller/includes/inicializa.php"); 

$emailDao = new EmailDAOImp($db);

$lista = $emailDao->listar10UltimosEmailsCadastrados();
$json = json_encode($lista, true);
echo $json;
	
?>

