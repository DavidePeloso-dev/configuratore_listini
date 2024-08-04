<section>
    <div class="alert alert-danger" role="alert">
        <strong>Alert Heading</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
</section>