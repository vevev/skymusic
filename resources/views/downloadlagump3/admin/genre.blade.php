@extends('downloadlagump3.layout.admin')
@section('title')
Genre - Admin Control Panel
@stop

@section('description')
Admin Control Panel
@stop

@section('sidebar')
<div class="col-0">
	<div class="sidebar">

	</div>
</div>
@endsection

@section('mainbar')
<div class="col-12" id="main">
	<div id="vue-container">
		<genre-index :categories="{{ $categories }}"></genre-index>
	</div>
</div>
@endsection
