@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>New Article</h2>
        <a href="{{route('admin.articles.index',$catalog->slug)}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.articles.store',$catalog->slug)}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Article Code</label>
            <input type="text" class="form-control" name="code" id="code" aria-describedby="articleCodeHelp" placeholder="" />
            <small id="articleCodeHelp" class="form-text text-muted">Type the Article's code</small>
            @error('code')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Article Height</label>
            <input type="number" class="form-control" name="height" id="height" aria-describedby="articleHeightHelp" placeholder="" />
            <small id="articleHeightHelp" class="form-text text-muted">Type the Article's height</small>
            @error('height')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="width" class="form-label">Article Width</label>
            <input type="number" class="form-control" name="width" id="width" aria-describedby="articleWidthHelp" placeholder="" />
            <small id="articleWidthHelp" class="form-text text-muted">Type the Article's width</small>
            @error('width')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="depth" class="form-label">Article Depth</label>
            <input type="number" class="form-control" name="depth" id="depth" aria-describedby="articleDepthHelp" placeholder="" />
            <small id="articleDepthHelp" class="form-text text-muted">Type the Article's depth</small>
            @error('depth')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category Id</label>
            <select class="form-select form-select-lg" name="category_id" id="category_id">
                <option value="" selected>Select a Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id')
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
            Create Article
        </button>

    </form>

</div>

@endsection