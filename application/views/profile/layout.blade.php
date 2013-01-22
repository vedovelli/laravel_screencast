@layout('layouts.main')

@section('main_content')
	@if ( Session::get('status') )
		{{ Alert::success( Session::get('status') ) }}
	@endif
	<h2>Profile information</h2>
	@yield('inner_content')
@endsection