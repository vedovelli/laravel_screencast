@layout('profile.layout')

@section('inner_content')

	<div class="controls controls-row btn-novo">
		{{ Form::button('Novo', array('class'=>'btn-primary pull-right')) }}
	</div>

	{{ Table::striped_bordered_hover_condensed_open(array('id'=>'profile_lista_container')) }}
	{{ Table::headers('#', 'First Name', 'Last Name', 'Editar', 'Excluir') }}
	{{ Table::body($body) }}
	{{ Table::close() }}
	{{ $paginate }}

@endsection