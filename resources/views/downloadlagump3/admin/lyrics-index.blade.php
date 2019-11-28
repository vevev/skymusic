@extends('layout.admin')
@section('title')
Lyrics - Admin Control Panel
@stop

@section('description')
Admin Control Panel
@stop
@section('id_main')
<div class="row">
    <div class="col-12">
	    <table class="table">
	    	<thead>
	    		<tr>
	    			<th scope="col">STT</th>
	    			<th scope="col">Name</th>
	    			<th scope="col">Download</th>
	    			<th scope="col">Lyric</th>
	    			<th scope="col">Action</th>
	    			<th scope="col">Index</th>
	    			<th scope="col">NoIndex</th>
	    		</tr>
	    	</thead>
	    	<tbody>
	    		<?php $i = 0;?>
	    		@foreach($song_list as $song)
	    		<?php $url = route('admin.lyric.create') . '?v=' . $song->video_id;?>
	    		<tr{!! $song->id ? ' style="background: #00fa0aa6;"' : '' !!}>
	    			<?php $i++;?>
	    			<td scope="col">{{ $i }}</td>
	    			<td scope="col"><a href="{{ $url }}">{{ $song->name }}</a></td>
	    			<td scope="col">{{ $song->count }}</td>
	    			<td scope="col">{{ $song->id ? 'added' : 'empty' }}</td>
	    			<td scope="col">
	    				<div class="onclick" data-id="{{ $song->video_id }}">
	    					Add
	    				</div>
	    			</td>
	    			<td scope="col">{!! !$song->id ? '<a href="#" onclick="_index(\'' . $song->video_id  . '\', this, event)">Index</a>' : 'Lyric Null' !!}</td>
	    			<td scope="col"><a href="#" onclick="_noindex('{{$song->video_id}}', this, event)">NoIndex</a></td>
	    		</tr>
	    		@endforeach
	    	</tbody>
	    </table>
	    <style type="text/css">
	    tr:hover {
		    background: #d3d3d3;
		}
	    </style>
	    <script>
	    	function _index(id, self, e){
	    		e.preventDefault();
	    		var token = '{{ csrf_token() }}';
	    		console.log(self.innerText = 'loadding');
	    		$.post('/admin/lyric', {
	    			v: id,
	    			content: '',
	    			_token: token
	    		}, function(e){
	    			console.log(self.innerText = 'OKI !!');
	    		})
	    		return;
	    	}

	    	function _noindex(id, self, e){
	    		e.preventDefault();
	    		var token = '{{ csrf_token() }}';
	    		console.log(self.innerText = 'loadding');
	    		$.post('/dmca/add', {
	    			v: id,
	    			content: '',
	    			_token: token
	    		}, function(e){
	    			console.log(this.parrentNode);
	    			console.log(self.innerText = 'OKI !!');
	    		})
	    		return;
	    	}
	    </script>
    </div>
</div>
@endsection
