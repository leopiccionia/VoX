$(function(){
	$('li.item-lista-pautas').click(function(e){
		var descricao = $(this).find('div.descricao-pauta');
		if(descricao.is(':hidden'))
			descricao.show('slow');
		else
			descricao.hide('slow');
	});
});