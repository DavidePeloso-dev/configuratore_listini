@extends('layouts.admin')

@section('content')

<div class="container my-3">

    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>New Catalogs</h2>
        <a href="{{route('admin.catalogs.index')}}">
            <span>Go Back </span>
            <i class="bi bi-arrow-left-circle"></i>
        </a>
    </div>

    @if($errors->any())
    @include('partials.error')
    @endif

    <form action="{{route('admin.catalogs.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Catalog Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="catalogNameHelp" placeholder="" />
            <small id="catalogNameHelp" class="form-text text-muted">Type the Catalog's Name</small>
            @error('name')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_of_publish" class="form-label">Publishing Date</label>
            <input type="date" class="form-control" name="date_of_publish" id="date_of_publish" aria-describedby="datePublishHelp" placeholder="" />
            <small id="datePublishHelp" class="form-text text-muted">Select the Publishing Date</small>
            @error('date_of_publish')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_of_ending" class="form-label">Dismissing Date</label>
            <input type="date" class="form-control" name="date_of_ending" id="date_of_ending" aria-describedby="dateDismissHelp" placeholder="" />
            <small id="dateDismissHelp" class="form-text text-muted">Select the Dismissing Date</small>
            @error('date_of_ending')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Create Catalog
        </button>

    </form>

</div>

@endsection