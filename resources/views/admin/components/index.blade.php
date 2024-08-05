@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>{{$category->name}}'s Components</h2>
        <div class="my-3 d-flex align-items-center gap-3">
            <a href="{{route('admin.components.create',[$catalog->slug,$category->slug])}}">
                <span>Add Component </span>
                <i class="bi bi-plus-circle"></i>
            </a>
            <a href="{{route('admin.categories.index',$catalog->slug)}}">
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
                    <th>thickness</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($components as $component)
                <tr class="">
                    <td scope="row">{{$component->id}}</td>
                    <td>{{$component->name}}</td>
                    <td>{{$component->slug}}</td>
                    @if($component->thickness->value ?? false)
                    <td>{{ $component->thickness->value }}</td>
                    @else
                    <td></td>
                    @endif

                    <td>
                        <a href="{{route('admin.components.edit',[$catalog->slug,$category->slug,$component->slug])}}" class="btn">Edit</a>
                        @include('admin.components.partials.delete-button')
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