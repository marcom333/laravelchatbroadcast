@extends('layouts.main')

@section('title',"login")

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> Hay problemas con tu formulario.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <h1>Login</h1>
    <div class="col-6">
        <form action="" method="post">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Email</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="">
                <small id="password" class="form-text text-muted">Password</small>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>

            <p><a href="{{url('user/register')}}">Create account</a></p>

        </form>
    </div>
@endsection