@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Default box -->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $product->id }}" class=""
                                        placeholder="id">

                                    <label for="name">Category:</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id', $product->category_id) == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                        placeholder="Name">
                                    @error('name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="detail">Detail:</label>
                                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                                    @error('detail')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><b>Select Image:</b></label>
                                    <input type="file" class="form-control" id="imgInput" name="image"
                                        accept="image/*">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->image }}"
                                        class="w-25 p-3" id="imgPreview">
                                    @error('image')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
            <!-- /.card -->
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#imgInput").change(function() {
                if (this.files && this.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
