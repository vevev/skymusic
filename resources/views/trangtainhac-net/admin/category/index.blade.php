@extends('trangtainhac-net.layouts.admin')

@section('content')
@php
$routes = new \stdClass;
$routes->store = route('admin.categories.store');
$routes->show = route('admin.videos.category.show', '');
$routes->update = route('admin.categories.update', '');
@endphp
<div class="row">
    <category-index :categories="{{ $categories }}" :routes="{{ json_encode($routes) }}"></category-index>
</div>
@endsection

@section('sidebar')

@endsection
