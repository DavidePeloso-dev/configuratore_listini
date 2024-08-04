@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Edit Category</h2>
        <a href="{{route('admin.categories.index',$catalog->slug)}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.categories.update',[$catalog->slug, $category->slug])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="categoryNameHelp" placeholder="" value="{{old('name',$category->name)}}" />
            <small id="categoryNameHelp" class="form-text text-muted">Type the category's Name</small>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="catalog_id" class="form-label">Catalog Id</label>
            <select class="form-select form-select-lg" name="catalog_id" id="catalog_id">
                <option selected>{{$catalog->id}}</option>
            </select>
            @error('catalog_id')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">
            Update Category
        </button>

    </form>

</div>

@endsection