{{-- Layout principal da aplicacao. --}}
{{-- Utiliza tanto a sintax do Blade template system quanto PHP puro --}}
{{-- Docs: http://laravel.com/docs/views/templating#blade-template-engine --}}

<?php
  /**
  * Registra meus arquivos CSS e JS customizados para a aplicacao
  */
  Asset::container('custom')->add('CustomJS', 'js/custom.js');
  Asset::container('custom')->add('CustomCSS', 'css/custom.css');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vedovelli using Laravel</title>
{{-- Adiciona tanto o CSS para o bundle Bootstrapper quando meus estilos custom --}}
{{ Asset::container('bootstrapper')->styles() }}
{{ Asset::container('custom')->styles() }}
</head>

<body>

<?php
  /**
  * Cria a barra de navegacao superior utilizando as classes do bundle Bootstrapper
  * Docs: http://bootstrapper.aws.af.cm/components#navbar
  */
  if( Auth::check() ){
    /**
    * Barra superior exibida quando usuario está logado
    */
  	echo Navbar::create( array('class'=>'navbar-inverse'), Navbar::FIX_TOP )
  	->collapsible()
  	->with_brand('Vedovelli Laravel', '/home')
  	->with_menus(
        Navigation::links(
          array(
            array('Home', '/home'),
            array('Profile', '/profile'),
            array('Dropdown', '#', false, false,
              array(
                array('Action', '#'),
                array('Another action', '#'),
                array('Something else here', '#'),
                array(Navigation::DIVIDER),
                array(Navigation::HEADER, 'Nav header'),
                array('Separated link', '#'),
                array('One more separated link', '#'),
              )
            )
          )
        )
      )
    ->with_menus(
        Navigation::links(
          array(
            array('Sair', '/access/logout'),
          )
        ), array('class'=>'pull-right')
      )
    ;
  } else {
    /**
    * Barra superior exibida quando usuario não esta logado
    */
    echo Navbar::create( array('class'=>'navbar-inverse'), Navbar::FIX_TOP )
      ->collapsible()
      ->with_brand('Vedovelli Laravel', '/home');
  }
?>
	<div id="main_container">
    {{-- Injeta a section encontrada nos templates que estendem este template principal --}}
		@yield('main_content')
	</div>

{{-- Adiciona tanto os JSs para o bundle Bootstrapper quando meus JSs custom --}}
{{ Asset::container('bootstrapper')->scripts() }}
{{ Asset::container('custom')->scripts() }}
</body>
</html>