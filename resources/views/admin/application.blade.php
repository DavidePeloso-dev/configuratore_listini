@extends('layouts.three')
@vite(['resources/js/sidebar.js'])
@section('content')
<?php
$articles = $catalogs[0]->articles;
?>
<div class="catalogs_menu">
    <ul class="ms-3 py-3"> <strong id="catalogs" class="pointer d-flex align-items-center gap-1"><i class="bi bi-plus-circle"></i> Catalogs</strong>
        @foreach($catalogs as $catalog)
        <li class="d-flex align-items-center gap-1 ms-3 my-2 d-none catalog pointer" data-articles="{{$catalog->articles}}"><i class="bi bi-arrow-return-right"></i> {{$catalog->name}}
        </li>
        @endforeach
    </ul>
</div>
<div class="container">
    <div class="articles_container row justify-content-center align-items-center my-3 gap-3">

    </div>
</div>

@endsection