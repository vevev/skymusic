@extends('downloadlagump3.layout.admin')
@section('title')
Genre - Admin Control Panel
@stop

@section('description')
Admin Control Panel
@stop

@section('sidebar')

@endsection

@section('mainbar')
<div class="col-12" id="main">
	<div id="vue-container">
		<genre-show :category_id="{{ $id }}"></genre-show>
	</div>
</div>
@endsection
