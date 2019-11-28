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
		<single-show :single_id="{{ $id }}"></single-show>
	</div>
</div>
@endsection
