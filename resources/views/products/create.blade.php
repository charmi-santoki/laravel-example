@extends('products.layout')
@section('content')
    <div class="card push-top">
        <div class="card-header">
            Add Product
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Category:</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
                </div>
                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" />
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="detail">Detail:</label>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                    @error('detail')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    @csrf
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block btn-primary">Create User</button>
            </form>
        </div>
    </div>
@endsection
