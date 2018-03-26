@if (count($errors) > 0)
<div class="error-form">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif


@if(session('success'))
        <div class="success">
            {{session('success')}}
        </div>
@endif

@if(session('error'))
        <div class="error">
            {{session('error')}}
        </div>
@endif

