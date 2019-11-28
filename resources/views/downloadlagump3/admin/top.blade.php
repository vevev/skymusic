@extends('downloadlagump3.layout.admin')
@section('title')
Top - Admin Control Panel
@stop

@section('description')
Admin Control Panel
@stop

@section('vuejs')
<script type="text/javascript" src="{{ asset('/js/admin.vue.js?v=' . config('app.version')) }}"></script>
@endsection

@section('sidebar')
<div class="col-3">
	<div class="sidebar">
		<ul>
			<li><h4>Tính Năng</h4></li>
			<li>- Lọc kết quả theo một ngày nào đó</li>
			<li>- Lọc kết quả theo Lyric</li>
			<li>- Chọn số hàng hiển thị</li>
			<li>- Phân Trang</li>
			<li>- Thêm, xóa bỏ DMCA</li>
			<li>- Thêm Null cho lyric ( mục đích là để set index )</li>
			<li>Một video được index khi và chỉ khi nó có lyric ( null hoặc text) và
			không bị DMCA</li>
		</ul>
	</div>
</div>
@endsection

@section('mainbar')
<div class="col-9" id="main">
	<div class="main_content">
		<div class="wr">
			<div class="waiting"></div>
		</div>
		<table class="table admin-table">
	    	<thead>
	    		<tr>
	    			<th>Name</th>
	    			<th>
    					<datepicker id="datepicker" @selected="date_change" format="yyyy/MM/dd"></datepicker>
    				</th>
	    			<th>
	    				<div class="btn-group filter">
							<button id="filter" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Lọc theo
							</button>
							<div class="dropdown-menu">
								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input cdmca" id="rqd1" value="dmca">
										<label class="custom-control-label" for="rqd1">Có DMCA</label>
									</div>
								</div>

								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input cdmca" id="rqd0" value="dmca">
										<label class="custom-control-label" for="rqd0">Không DMCA</label>
									</div>
								</div>
								<div class="dropdown-divider"></div>
								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input clyric" id="rqlr1" value="lyric">
										<label class="custom-control-label" for="rqlr1">Có Lời (không Null)</label>
									</div>
								</div>

								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input clyric" id="rqlr2" value="lyric">
										<label class="custom-control-label" for="rqlr2">Có Lời (Null)</label>
									</div>
								</div>

								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input clyric" id="rqlr0" value="lyric">
										<label class="custom-control-label" for="rqlr0">Không Lời</label>
									</div>
								</div>

								<div class="dropdown-divider"></div>
								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input chide" id="rqh1" value="hide">
										<label class="custom-control-label" for="rqh1">Đang bị ẩn</label>
									</div>
								</div>

								<div class="dropdown-divider"></div>
								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input cdirect" id="dr2" value="direct">
										<label class="custom-control-label" for="dr2">Direct</label>
									</div>
								</div>

								<div class="dropdown-item">
									<div class="custom-control custom-checkbox">
										<input @click="validate_checkbox"  type="checkbox" class="custom-control-input cdirect" id="dr3" value="direct">
										<label class="custom-control-label" for="dr3">Direct All</label>
									</div>
								</div>
							</div>
						</div>
					</th>
					<th>
						<select @change="selectRow" class="custom-select custom-select-sm" id="select-row">
							<option selected>Số hàng</option>
							<option value="25">25 hàng</option>
							<option value="50">50 hàng</option>
							<option value="100">100 hàng</option>
							<option value="200">200 hàng</option>
							<option value="400">400 hàng</option>
							<option value="800">800 hàng</option>
						</select>
					</th>
					<th>ID</th>
					<th>Status</th>
					<th>
	    				<div class="input-group">
	    					<div class="custom-file input-group-sm">
	    						<input type="text" @keyup="filter_text($event)" class="form-control" id="filter_text" placeholder="nhap tu khoa">
	    					</div>
						</div>
	    			</th>
	    			<th>Count</th>
	    			<th>Action</th>
	    		</tr>
	    	</thead>
	    	<tbody v-if="songs[0]">
	    		{{-- @foreach($songs as $song)
	    		<tr>
	    			<td><a class="song-name" href="#">{{ $song->name }}</a></td>
	    			<td colspan="4">Status</td>
	    			<td>{{ $song->count }}</td>
	    			<td><a href="#" @click="setIndex" data-id="{{ $song->video_id }}" class="text-primary font-weight-bold">Index</a></td>
	    		</tr>
	    		@endforeach --}}
	    		<tr
					is="rowdata"

					v-for="(song, index) in songs"
					:direct_video_id="song.direct_video_id"
					:hide_video_id="song.hide_video_id"
					:index="song.index"
					:name="song.name"
					:slug="song.slug"
					:count="format_number(song.count)"
					:video_id="song.video_id"
					:hide_video_id="song.hide_video_id"
					:lyric="song.lyric"
					:lr_exists="song.lr_exists"
					:dmca="song.dmca"
					@set-dmca="setDmca(index, song.video_id)"
					@remove-dmca="removeDmca(index, song.video_id)"
					@add-lyric="addLyric(index, song.video_id)"
					@add-lyric-null="addLyricNull(index, song.video_id)"
					@edit-lyric="editLyric(index, song.video_id)"
					@hide-row="hideRow(index, song.video_id)"
					@unhide-row="unhideRow(index, song.video_id)"
					@set-direct="setDirect(index, song.video_id)"
					@remove-direct="removeDirect(index, song.video_id)"
				></tr>
	    	</tbody>
	    	<tbody v-else>
	    		<tr>
					<td colspan="9">
						<div class="alert alert-info text-center" role="alert">
							Không có dữ liệu để hiển thị
						</div>
					</td>
				</tr>
			</tbody>
	    </table>
    	<nav aria-label="Page navigation example" class="pb-2">
			<ul class="pagination justify-content-center">
				<li class="page-item"><a @click="paginate(page - 1)" class="page-link" href="#">Prev</a></li>
				<li class="page-item disabled"><a class="page-link" href="#">@{{ page }}</a></li>
				<li class="page-item"><a @click="paginate(page + 1)"class="page-link" href="#">Next</a></li>
			</ul>
		</nav>
	</div>


</div>
{{-- Modal theem lyric --}}
<div class="modal fade" id="add-lyrci-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 v-if="method" class="modal-title text-truncate" id="add-lyric-modal-label">Sửa lời: @{{ name }}</h5>
				<h5 v-else class="modal-title text-truncate" id="add-lyric-modal-label">Thêm lời: @{{ name }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<a class="btn btn-primary" :href="build_search()" target="_blank">Tìm Kiếm Lời</a>
				<div v-if="state == 1" class="alert alert-primary mt-2" role="alert">
					@{{ suc_str }}
				</div>
				<div v-else-if="state == 0" class="alert alert-danger mt-2" role="alert">
					@{{ err_str }}
				</div>
				<form class="mt-2" id="add-lyric-form">
					<input v-if="method" name="_method" type="hidden" value="PUT">
					<input id="input-video-id" type="hidden" name="v" :value="video_id">
					<div class="form-group">
						<textarea name="content" rows="10" class="form-control" id="message-text" placeholder="Thêm lời bài hát vào đây">@{{ content }}</textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<i class="loading"></i>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button v-if="method" type="button" class="btn btn-primary" id="edit-btn">Sửa Lời</button>
				<button v-else type="button" class="btn btn-primary" id="add-btn">Thêm Lời</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('.datepicker').datepicker({
		}).on('changeDate', function (e) {console.log($(this));
			document.getElementById("#datepicker").dispatchEvent('change');
		  	//$(this).trigger('change');
		});
	});
</script>
@endsection
