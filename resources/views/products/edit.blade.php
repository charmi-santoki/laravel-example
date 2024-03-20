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
                <input type="hidden" name="id" value="{{ $product->id }}" class="form-control"
                placeholder="id">
                <div class="form-group">
                    <label for="name">Category:</label>
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if(old('category_id',$product->category_id) == $category->id) selected @endif >
                            {{ $category->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                        placeholder="Name">
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
                    <label><b>Select Image:</b></label>
                    <input type="file" class="form-control" id="imgInput" name="image" accept="image/*">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->image }}" class="w-25 p-3"
                        id="imgPreview">
                </div>
                <button type="submit" class="btn btn-block btn-primary">Create User</button>
            </form>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
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
