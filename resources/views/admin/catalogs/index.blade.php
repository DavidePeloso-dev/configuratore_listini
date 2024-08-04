@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="my-3 d-flex align-items-center justify-content-between">
        <h2>Catalogs</h2>
        <a href="{{route('admin.catalogs.create')}}">
            <span>Add Catalog </span>
            <i class="bi bi-plus-circle"></i>
        </a>
    </div>

    @include('partials.session-message')

    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless align-middle">
            <thead class="table-light">
                <tr class="align-middle">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Publishing Date</th>
                    <th>In Use</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                @forelse ($catalogs as $catalog)
                <tr class="">
                    <td scope="row">{{$catalog->id}}</td>
                    <td>{{$catalog->name}}</td>
                    <td>{{join('-',array_reverse(explode('-',$catalog->date_of_publish)))}}</td>
                    <td>
                        <input type="checkbox" class="ms-3" name="" id="" disabled {{($catalog->date_of_ending == null || intval(date_diff(date_create(date('y-m-d')),date_create($catalog->date_of_ending))->format('%R%a')) > 0) && intval(date_diff(date_create(date('y-m-d')),date_create($catalog->date_of_publish))->format('%R%a')) < 0  ? 'checked': ''}} />
                    </td>
                    <td>
                        <a href="{{route('admin.catalogs.show',$catalog)}}" class="btn">View</a>
                        <a href="{{route('admin.catalogs.edit',$catalog)}}" class="btn">Edit</a>
                        @include('admin.catalogs.partials.delete-button')
                        <!-- <a href="{{route('admin.catalogs.destroy',$catalog)}}" class="btn">Delete</a> -->
                    </td>
                </tr>
                @empty
                <tr class="">
                    <td colspan="5" scope="row">No Catalogs Found!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>

@endsection()