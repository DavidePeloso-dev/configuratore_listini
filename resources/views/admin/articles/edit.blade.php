@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Edit Article</h2>
        <a href="{{route('admin.articles.index',$catalog->slug)}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.articles.update',[$catalog->slug, $article->code])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Article Code</label>
            <input type="text" class="form-control" name="code" id="code" aria-describedby="articleCodeHelp" placeholder="" value="{{old('code',$article->code)}}" />
            <small id="articleCodeHelp" class="form-text text-muted">Type the Article's code</small>
            @error('code')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Article Height</label>
            <input type="number" class="form-control" name="height" id="height" aria-describedby="articleHeightHelp" placeholder="" value="{{old('height',$article->height)}}" />
            <small id="articleHeightHelp" class="form-text text-muted">Type the Article's height</small>
            @error('height')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="width" class="form-label">Article Width</label>
            <input type="number" class="form-control" name="width" id="width" aria-describedby="articleWidthHelp" placeholder="" value="{{old('width',$article->width)}}" />
            <small id="articleWidthHelp" class="form-text text-muted">Type the Article's width</small>
            @error('width')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="depth" class="form-label">Article Depth</label>
            <input type="number" class="form-control" name="depth" id="depth" aria-describedby="articleDepthHelp" placeholder="" value="{{old('depth',$article->depth)}}" />
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
                <option value="{{$category->id}}" {{old('category_id', $article->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
            Update Article
        </button>

    </form>

</div>

@endsection