@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>{{$catalog->name}}</h2>
        <a href="{{route('admin.catalogs.index')}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>

    </div>

    <div>
        <a href="{{route('admin.categories.index',$catalog->slug)}}">
            <h5>Articles Categories</h5>
        </a>
        <a href="#">
            <h5>Articles</h5>
        </a>
        <a href="{{route('admin.thicknesses.index',$catalog->slug)}}">
            <h5>Thicknesses</h5>
        </a>
        <a href="#">
            <h5>Colors</h5>
        </a>
    </div>
</div>

@endsection()