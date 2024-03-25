@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome</h1>

        <!-- Display success or error messages if any -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Display saved paintings -->
        <div class="row">
            @foreach ($paintings as $painting)
                <div class="col-md-4 mb-3">
                    <img src="{{ Storage::url($painting->image) }}" alt="Painting" class="img-fluid">
                </div>
            @endforeach
        </div>
    </div>
@endsection
