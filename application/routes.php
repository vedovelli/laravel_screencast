<?php

/**
* Este é o arquivo que mapeia as URLs para as ações da sua aplicação.
* É a porta de entrada da app. O Laravel lhe permite utilizar as rotas
* de duas formas: 1) utilizando closures (métodos anônimos) e tratando
* do comportamento da app diretamente neste arquivo (recomenado para
* apps pequenas e testes) e 2) mapeando para ações contidas nos controllers
* (método considerado best practice). De qualquer forma, Laravel lhe dá
* a flexibilidade de utilizar ambos na mesma app. Fica a seu critério.
* Eu sempre utilizo Controllers, pois valorizo bastante a separação de 
* responsabilidades.
*/


/**
* A rota root da app redirectiona para action index do controller home
*/
Route::get('/', function(){
	return Redirect::to('home');
});

Event::listen('404', function(){
	return Response::error('404');
});

Event::listen('500', function(){
	return Response::error('500');
});

// Route::filter('before', function()
// {
// });

// Route::filter('after', function($response)
// {
// });

Route::filter('csrf', function(){
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function(){
	/**
	* Caso não haja usuario logado. Outra forma de verificar seria !Auth::check()
	*/
	if (Auth::guest()) {
		/**
		* Redireciona para o controller acess action index passando feedback para usuario
		*/
		return Redirect::to('access')->with('warning', 'Login necessário');
	}
});

/**
* Cria automaticamente as rotas para actions dos controllers.
* Todos os métodos dos controllers abaixo que contém o prefixo
* action_ responderão automaticamente quando a URL for acessada.
* Ex. function action_lista() em Profile_Controller será executado
* quando a URL http://seu_host/profile/lista for acessada.
*/
Route::controller('home');
Route::controller('profile');
Route::controller('user');
Route::controller('access');