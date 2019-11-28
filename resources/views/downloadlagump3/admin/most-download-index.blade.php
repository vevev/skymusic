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
	<div class="main_content">
		<div id="vue-container">
			<most-download-index></most-download-index>
		</div>

    </div>
</div>
@endsection
