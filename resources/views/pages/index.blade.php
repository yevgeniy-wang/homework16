@extends('layout')

@section('title', 'Homepage')

@section('auth')
    @auth
        <div class="mb-3">
            <h4>Hello, {{request()->user()->name}}!</h4>
        </div>
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('create') }}">Create ad</a>
        </div>
        <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('logout') }}">Log out</a>
        </div>
    @else
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Username : </label>
                <input type="name" class="form-control" name="name" id="name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password : </label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary mb-3" value="Log in">
            </div>
            <div class="mb-3">
                @if($errors->has('password'))
                    @foreach($errors->get('password') as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            @csrf
        </form>
    @endauth
@endsection

@section('content')
    <div class="mb-3">
        <a class="btn btn-primary" href="../">Back</a>
    </div>
    <div class="mb-3">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <ul class="list-group">
            @foreach($ads as $ad)
                <li class="list-group-item">
                    <div class="mb-3">
                        <h3><a href="{{ route('read', $ad->id) }}">{{ $ad->title }}</a></h3>
                        <p>{{ $ad->description }}</p>
                        <p>{{ $ad->user->name }}</p>
                        <p>{{ $ad->created_at->diffforhumans() }}</p>
                        @can('delete', $ad)
                            <div class="mb-3">
                                <a class="btn btn-primary" href="{{ route('delete', $ad->id) }}">Delete</a>
                            </div>
                        @endcan
                        @can('update', $ad)
                            <div class="mb-3">
                                <a class="btn btn-primary" href="{{ route('edit', $ad->id) }}">Edit</a>
                            </div>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    @if(request()->getPathInfo() == '/')
        @include('paginator', ['table' => $ads])
    @endif
@endsection
