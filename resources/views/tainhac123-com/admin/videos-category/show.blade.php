@extends('tainhac123-com.layouts.admin')

@section('content')
@php
$routes = new \stdClass;
$routes->search = route('search_api', '');
@endphp
<div class="row">
    <category-show :videos='{{ $videos->toJson() }}' :category='{{ $category->toJson() }}' :routes="{{ json_encode($routes) }}"></category-show>
</div>
@endsection

@section('sidebar')

@endsection
