@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2>Edit Category</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Category</button>
        </form>
    </div>
@endsection
