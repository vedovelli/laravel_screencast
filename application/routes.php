<?php

/**
* A rota toor da app mostra a action index do controller home
*/
Route::get('/', function()
{
	return Redirect::to('home');
});

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

Route::filter('before', function()
{
});

Route::filter('after', function($response)
{
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
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
* Cria automaticamente as rotas para actions dos controllers
*/
Route::controller('home');
Route::controller('profile');
Route::controller('user');
Route::controller('access');