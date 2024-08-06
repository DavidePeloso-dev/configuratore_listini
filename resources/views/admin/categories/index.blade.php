@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Categories</h2>
        <div class="my-3 d-flex align-items-center gap-3">
            <a href="{{route('admin.categories.create',$catalog->slug)}}">
                <span>Add Category </span>
                <i class="bi bi-plus-circle"></i>
            </a>
            <a href="{{route('admin.catalogs.show',$catalog)}}">
                <span>Go Back </span>
                <i class="bi bi-arrow-left-circle"></i>
            </a>
        </div>
    </div>

    @include('partials.session-message')

    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless align-middle">
            <thead class="table-light">
                <tr class="align-middle">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($categories as $category)
                <tr class="">
                    <td scope="row">{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>

                    <td>
                        <a href="{{route('admin.components.index',[$catalog->slug,$category->slug])}}" class="btn">View</a>
                        <a href="{{route('admin.categories.edit',[$catalog->slug,$category->slug])}}" class="btn">Edit</a>
                        @include('admin.categories.partials.delete-button')
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5" scope="row">No Categories Found!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>

@endsection()