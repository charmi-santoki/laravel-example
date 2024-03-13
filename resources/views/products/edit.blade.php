@extends('products.layout')
@section('content')
    <div class="card push-top">
        <div class="card-header">
            Edit Product
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">

                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                    @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                    @error('detail')
                    <div class="error">{{ $message }}</div>
                @enderror
                </div>
                <div class="form-group">
                    @csrf
                    <label for="image">Image:</label>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/images/{{ $product->image }}" width="300px">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block btn-primary">Create User</button>
            </form>
        </div>
    </div>
@endsection
