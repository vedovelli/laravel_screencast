@layout('profile.layout')

@section('inner_content')

	<?php
		if( count($errors->messages) > 0 ){

			$error_message = array();
			$error_message[] = '<ul>';

			foreach ($errors->messages as $key => $value) {
				$error_message[] = '<li>'.$value[0].'</li>';
			}

			$error_message[] = '</ul>';

			echo Alert::error( implode("", $error_message) );
		}

		if( count( Input::old() ) > 0 ){
			$user = Input::old();
		}

	?>

	{{ Form::vertical_open('profile/salvar', 'POST', array('class'=>'well')) }}
	{{ Form::hidden('id', $user['id']) }}
	{{ Form::label('firstname', 'First name') }}
	{{ Form::span6_text('firstname', $user['firstname']) }}
	{{ Form::label('lastname', 'Last name') }}
	{{ Form::span6_text('lastname', $user['lastname']) }}
	<p>{{ Form::submit('Salvar', array('class'=>'btn-primary')) }}</p>
	{{ Form::close() }}
	{{ HTML::link_to_action('profile', 'voltar', array()) }}
@endsection