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
                    <label><b>Select Image:</b></label>
                    <input type="file" class="form-control" id="imgInput" accept="image/*">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->image }}" class="w-25 p-3"
                        id="imgPreview">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
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
