@extends('layout.admin')
@section('title')
Lyrics - Admin Control Panel
@stop

@section('description')
Admin Control Panel
@stop
@section('id_main')
<div class="row">
    <div class="col-8 offset-2">
        <div class="card">
				<div class="card-header">
                <?php $content = "";?>
                @if(!empty($data))
					<h5><a target="_blank" href="http://google.co.id/search?q=lirik+{{ $data->name }}">{{ $data->name }}</a></h5>
                    @if(isset($data->lyrics))
                        <?php $content = $data->lyrics;?>
                    @endif
                @endif

            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.lyric.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="v" value="{{ request()->get('v') }}">
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                        <label for="text-box">Lời bài hát</label>
                        <textarea name="content" class="form-control editor" id="text-box" rows="10">{{ $content }}</textarea>
                        @if($errors->has('content'))
                            <span class="help-block">
                                {{ $errors->first('content') }}
                            </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu lời bài hát</button>
                </form>
        	</div>
        </div>
    </div>
</div>
@endsection
