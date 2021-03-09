@extends('layout')


@section('title', 'Ad')


@section('content')
    <form method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="{{ @old('title', $ad->title ?? null) }}">
        </div>
        @if ($errors->has('title'))
            @foreach($errors->get('title') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" cols="30"
                      rows="10">{{ @old('description', $ad->description ) }}</textarea>
        </div>
        @if ($errors->has('description'))
            @foreach($errors->get('description') as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @csrf

        <div class="mb-3">
            <input type="submit" class="btn btn-primary mb-3"
                   value="@if($submit) Create @else Save @endif">
        </div>
    </form>
@endsection
