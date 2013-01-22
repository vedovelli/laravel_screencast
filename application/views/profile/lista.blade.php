{{-- Layout parent deste template --}}
@layout('profile.layout')

{{-- As sections sao referenciadas e injetadas no template parent determinado acima --}}
@section('inner_content')

	{{-- @todo: remover o HTML e utilizar o bundle Bootstrapper para gerar o div.controls --}}
	<div class="controls controls-row btn-novo">
		{{ Form::button('Novo', array('class'=>'btn-primary pull-right')) }}
	</div>

	{{-- A tabela é gerada pelo bundle Bootstrapper --}}
	{{-- Docs: http://bootstrapper.aws.af.cm/basecss#tables --}}
	{{ Table::striped_bordered_hover_condensed_open(array('id'=>'profile_lista_container')) }}
	{{ Table::headers('#', 'First Name', 'Last Name', 'Editar', 'Excluir') }}
	{{ Table::body($body) }}
	{{ Table::close() }}

	{{-- Links da paginacao, prontos e fornecidos pelo controller \o/ Coisa linda de dells! --}}
	{{ $paginate }}

@endsection