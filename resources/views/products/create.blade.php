@extends('layouts.app-bootstrap')

@push('title', 'Product Management')

@section('pageContent')
    <div class="container mt-4">
        <h3 class="mb-3">New product</h3>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check2-circle"></i> {{ session('success') }}
            </div>
        @endisset

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="product_image" class="form-label">Product picture</label>
                        <input class="form-control" type="file" id="product_image" name="product_image" placeholder="Choose a picture">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mt-lg-0">
                                <input type="text"
                                       class="form-control @error('product_name') is-invalid @enderror"
                                       id="productName"
                                       name="product_name"
                                       placeholder="Product's name"
                                       value="{{ old('product_name') }}" autofocus>
                                <label for="productName">Product's name</label>
                                @error('product_name')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mt-lg-0">
                                <input type="number"
                                       step=".01"
                                       class="form-control @error('price') is-invalid @enderror"
                                       id="price"
                                       name="price"
                                       value="{{ old('price') }}"
                                       placeholder="0.00">
                                <label for="price">Price</label>
                                @error('price')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mt-lg-0">
                                <input type="number"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       id="stock"
                                       name="stock"
                                       value="{{ old('stock') }}"
                                       placeholder="0">
                                <label for="stock">Available stock</label>
                                @error('stock')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mt-3">
                <textarea class="form-control"
                          id="description"
                          name="description"
                          placeholder="Leave a short description here">{{ old('description') }}</textarea>
                        <label for="description">Short description</label>
                    </div>
                    <div class="d-flex mt-3 justify-content-end">
                        <button type="submit" class="btn btn-success me-3">
                            <i class="bi bi-download"></i> Save
                        </button>
                        <a href="{{ route('products.index') }}"
                           class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
