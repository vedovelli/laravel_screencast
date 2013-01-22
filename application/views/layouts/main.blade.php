<?php
Asset::container('custom')->add('CustomJS', 'js/custom.js');
Asset::container('custom')->add('CustomCSS', 'css/custom.css')
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Vedovelli using Laravel</title>
{{ Asset::container('bootstrapper')->styles() }}
{{ Asset::container('custom')->styles() }}
</head>

<body>

<?php
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
    );
?>
	<div id="main_container">
		@yield('main_content')
	</div>

{{ Asset::container('bootstrapper')->scripts() }}
{{ Asset::container('custom')->scripts() }}
</body>
</html>