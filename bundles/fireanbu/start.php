<?php

/*
|--------------------------------------------------------------------------
| Include Vendors
|--------------------------------------------------------------------------
|
| Include FirePHP class as FireAnbu dependency.
|
*/

Autoloader::map(array(
	'FirePHP' => Bundle::path('fireanbu').'vendors'.DS.'FirePHPCore'.DS.'FirePHP.class'.EXT,
));

/*
|--------------------------------------------------------------------------
| FireAnbu IoC
|--------------------------------------------------------------------------
|
| Register FirePHP singleton using IoC, in case you need to overwrite the 
| implementation in your application.
|
*/

IoC::singleton('fireanbu', function ()
{
	$fb = new FirePHP;
	$fb->setEnabled(Config::get('fireanbu::fireanbu.profiler', true));

	return $fb;
});

/*
|--------------------------------------------------------------------------
| Listen to `laravel.log` events
|--------------------------------------------------------------------------
*/

Event::listen('laravel.log', function ($type, $message)
{
	$fb = IoC::resolve('fireanbu');
	
	switch (Str::upper($type))
	{
		case FirePHP::INFO :
		case FirePHP::WARN :
		case FirePHP::LOG :
		case FirePHP::ERROR :
			$fb->{$type}($message);
			break;
		default :
			$fb->log($message);
			break;
	}
});

/*
|--------------------------------------------------------------------------
| Listen to `laravel.query` events
|--------------------------------------------------------------------------
*/

Event::listen('laravel.query', function($sql, $bindings, $time)
{
	$fb = IoC::resolve('fireanbu');

	foreach ($bindings as $binding)
	{
		$binding = \DB::connection()->pdo->quote($binding);

		$sql = preg_replace('/\?/', $binding, $sql, 1);
		$sql = htmlspecialchars($sql);
	}

	$fb->info($sql, "{$time}ms");
});
