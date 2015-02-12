<?php
/**
 * Classe de acesso aos Emails cadastradas na base de dados
 */
interface EmailDAO 
{	
	public function adicionarEmailSeNaoExistir($email);
	
	public function listar10UltimosEmailsCadastrados();
	
}


?>