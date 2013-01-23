@layout('layouts.main') {{-- Layout parent deste template --}}

{{-- Section que sera inserida no template parent, determinado acima --}}
@section('main_content')

	{{ Form::vertical_open('access/login', 'POST', array('class'=>'well login-form')) }}

	{{-- Caso uma informacao tenha sido passada, exibe com o Alert::success do bundle Bootstrapper --}}
	@if ( Session::get('info') )
		{{ Alert::success( Session::get('info') )->open() }}
	@endif

	{{-- Caso um warning tenha sido passada, exibe com o Alert::error do bundle Bootstrapper --}}
	@if ( Session::get('warning') )
		{{ Alert::error( Session::get('warning') )->open() }}
	@endif

	{{-- Monta o form --}}
	{{ Form::label('username', 'Username') }}
	{{ Form::span3_text('username', Input::old('username') ) }}
	{{ Form::label('password', 'Password') }}
	{{ Form::span3_password('password') }}
	{{ Form::labelled_checkbox('remember', 'Remember me') }}
	<p>{{ Form::submit('Login', array('class'=>'btn-primary')) }}</p>
	{{ Form::close() }}

@endsection