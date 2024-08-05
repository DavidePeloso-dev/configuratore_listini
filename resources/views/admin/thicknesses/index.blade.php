@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Thicknesses</h2>
        <div class="my-3 d-flex align-items-center gap-3">
            <a href="{{route('admin.thicknesses.create',$catalog->slug)}}">
                <span>Add Thickness </span>
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
                    <th>Thickness</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($thicknesses as $thickness)
                <tr class="">
                    <td scope="row">{{$thickness->id}}</td>
                    <td>{{$thickness->value}}</td>

                    <td>
                        <a href="{{route('admin.thicknesses.edit',[$catalog->slug,$thickness->value])}}" class="btn">Edit</a>
                        @include('admin.thicknesses.partials.delete-button')
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5" scope="row">No thicknesses Found!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>

@endsection()