var idHandlerConsultarServidor;

$(document).ready(function() {
	try
	{
		idHandlerConsultarServidor = setInterval(atualizarEmails, 1000);
	}
	catch(e)
	{
		alert("Ocorreu um erro ao carregar a tela. Detalhes do erro:"+e);
	}
});

function atualizarEmails() {
	var requisicao = $.ajax({
		url: "carregarLista.php",
		type: "GET",
		dataType: "json"
	});
	
	requisicao.done(function(data, textStatus, jqXHR){
		try 
		{
			if(data){
				var emails = "";
				var total = data.length;
				for(var i=0;i<total;i++) {
					emails += data[i]+"<br/>";				
				}
				$("#emails").html(emails);
			}
			else {
				$("#emails").html("sem emails");
			}
		}
		catch(e)
		{
			alert("Ocorreu um erro ao recuperar a lista de emails. Detalhes do erro:"+e);
		}
		
	});
	
	
	requisicao.fail(function( jqXHR, textStatus, errorThrown) {
		alert("Ocorreu um error. Para continuar carregando os emails atualize o navegador. Detalhes do erro: "+textStatus );
		window.clearInterval(idHandlerConsultarServidor);
	});
	
	
}