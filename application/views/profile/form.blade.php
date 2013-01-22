{{-- Layout parent deste template --}}
@layout('profile.layout')

{{-- As sections sao referenciadas e injetadas no template parent determinado acima --}}
@section('inner_content')

	<?php
		/**
		* Monta a mensagem de erro, caso seja passada
		*/
		if( count($errors->messages) > 0 ){

			$error_message = array();
			$error_message[] = '<ul>';

			foreach ($errors->messages as $key => $value) {
				$error_message[] = '<li>'.$value[0].'</li>';
			}

			$error_message[] = '</ul>';
			/**
			* Exibe a mensagem de erro apurada acima num Alert do Twitter Bootstrapper.
			* A classe Alert do bundle Bootstrapper é utilizada
			* Docs: http://bootstrapper.aws.af.cm/components#alerts
			*/
			echo Alert::error( implode("", $error_message) );
		}

		/**
		* Caso exista algum valor passado pelo controller no caso de erro
		* Utiliza os valores passados. Caso não, a variavel $user sera
		* abastecida pelo metodo profile@form (controller@action)
		*/
		if( count( Input::old() ) > 0 ){
			$user = Input::old();
		}

	?>

	{{-- Utiliza as classes do bundle Bootstrapper para gerar o HTML do form --}}
	{{-- Docs: http://bootstrapper.aws.af.cm/basecss#forms --}}
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