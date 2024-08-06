@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>articles</h2>
        <div class="my-3 d-flex align-items-center gap-3">
            <a href="{{route('admin.articles.create',$catalog->slug)}}">
                <span>Add Article </span>
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
                    <th>Code</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Depth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($articles as $article)
                <tr class="">
                    <td scope="row">{{$article->id}}</td>
                    <td>{{$article->code}}</td>
                    <td>{{$article->height}}</td>
                    <td>{{$article->width}}</td>
                    <td>{{$article->depth}}</td>

                    <td>
                        <a href="{{route('admin.articles.show',[$catalog->slug,$article->code])}}" class="btn">View</a>
                        <a href="{{route('admin.articles.edit',[$catalog->slug,$article->code])}}" class="btn">Edit</a>
                        @include('admin.articles.partials.delete-button')
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="6" scope="row">No Articles Found!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>

@endsection()