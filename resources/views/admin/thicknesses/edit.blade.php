@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Edit Thickness</h2>
        <a href="{{route('admin.thicknesses.index',$catalog->slug)}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.thicknesses.update',[$catalog->slug, $thickness->value])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="value" class="form-label">Thickness Value</label>
            <input type="number" class="form-control" name="value" id="value" aria-describedby="valueHelp" placeholder="" value="{{old('value',$thickness->value)}}" />
            <small id="valueHelp" class="form-text text-muted">Type the thickness</small>
            @error('value')
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
            Update thickness
        </button>

    </form>

</div>

@endsection