{{-- Layout parent deste template --}}
@layout('layouts.main')

{{-- As sections sao referenciadas e injetadas no template parent determinado acima --}}
@section('main_content')
	{{-- Caso exista em memoria informacao de status, exibe utilizando Alert do Twitter Bootstrap --}}
	@if ( Session::get('status') )
		{{ Alert::success( Session::get('status') ) }}
	@endif

	<h2>Profile information</h2>

	{{-- Recebe o conteudo do template que estende este layout --}}
	{{-- Ver: form.blade.php e lista.blade.php @section('inner_content') --}}
	@yield('inner_content')

@endsection