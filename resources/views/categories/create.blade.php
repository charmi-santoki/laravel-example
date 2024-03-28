@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        @if (isset($category))
            <form action="{{ route('categories.update', $category->id) }}" id="category_form" method="POSt">

                @method('PUT')
            @else
                <form action="{{ route('categories.store') }}" id="category_form" method="POST">
        @endif
        @csrf
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}"
                                    value="{{ old('name', $category->name ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Detail</label>
                                <input type="text" name="detail" class="form-control" placeholder="{{ __('Detail') }}"
                                    value="{{ old('detail', $category->detail ?? '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary">Create</button>
                <a href="brands.html" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
