@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Edit {{$category->name}}'s Component</h2>
        <a href="{{route('admin.components.index',[$catalog->slug,$category->slug])}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.components.update',[$catalog->slug, $category->slug,$component->slug])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Component Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="componentNameHelp" placeholder="" value="{{old('name',$component->name)}}" />
            <small id="componentNameHelp" class="form-text text-muted">Type the component's Name</small>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category Id</label>
            <select class="form-select form-select-lg" name="category_id" id="category_id">
                <option selected>{{$category->id}}</option>
            </select>
            @error('category_id')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">
            Update Component
        </button>

    </form>

</div>

@endsection