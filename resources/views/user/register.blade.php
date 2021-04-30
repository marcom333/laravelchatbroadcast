
@extends('layouts.main')

@section('title',"Register")

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

    <h1>Register</h1>
    <div class="col-6">
        <form action="" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpName" placeholder="">
                <small id="helpName" class="form-text text-muted">Name</small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Email</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpPassword" placeholder="">
                <small id="helpPassword" class="form-text text-muted">Password</small>
            </div>

            <button type="submit" class="btn btn-primary">Register</button>

        </form>
    </div>
@endsection