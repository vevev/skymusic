@extends('tainhac123-com.layouts.admin')

@section('content')
<div class="row">
    <ul class="component half left">
        <li><h2>Lagu Dangdut</h2></li>
        @foreach($data as $category)
            {{ $category->toJson() }}
        @endforeach
    </ul>
</div>
@endsection

@section('sidebar')
    <ul class="component options">
        <li><h2>Lagu Dangdut</h2></li>
        <li><form-search /></li>
        <li><a href="#">Chuc nang 1</a></li>
        <li><a href="#">Chuc nang 2</a></li>
        <li><a href="#">Chuc nang 3</a></li>
        <li><a href="#">Chuc nang 4</a></li>
    </ul>
@endsection
