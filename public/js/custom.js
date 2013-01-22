jQuery(document).ready(function($){

	var
		body 							= $('body'),
		profile_lista_container 		= $('#profile_lista_container'),
		alert_success 					= $('.alert-success'),
		btn_novo 						= $('.btn-novo button');
	;

	btn_novo.on('click', function(){
		window.location = '/profile/form';
	});

	profile_lista_container.on('click', '.link_excluir', function(event){
		event.preventDefault();
		var
			link = $(event.currentTarget),
			href = link.attr('href'),
			confirm = window.confirm('Tem certeza que deseja excluir o profile?')
		;

		if(confirm){
			window.location = href;
		}
	});

	if( alert_success.is(':visible') ){
		alert_success.delay(4000).fadeOut(2000);
	}
});