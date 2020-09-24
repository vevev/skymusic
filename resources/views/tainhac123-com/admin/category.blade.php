@extends('downloadlagu123.layouts.admin')

@section('content')
<div class="row">
    <category :videos='{{ $videos->toJson() }}' :category='{{ $category->toJson() }}'></category>
</div>
@endsection

@section('sidebar')
    <ul class="component options">
        <li><h2>Lagu Dangdut</h2></li>
        <li><a href="#">Chuc nang 1</a></li>
        <li><a href="#">Chuc nang 2</a></li>
        <li><a href="#">Chuc nang 3</a></li>
        <li><a href="#">Chuc nang 4</a></li>
    </ul>
@endsection
