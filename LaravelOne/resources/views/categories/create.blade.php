@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2>Add New Category</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Add Category</button>
        </form>
    </div>
@endsection
