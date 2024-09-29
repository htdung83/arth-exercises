@extends('layouts.app-bootstrap')

@push('title', 'Product Management')

@section('pageContent')
    <div class="container mt-4">
        <h3>Product List</h3>

        <div class="row mb-3">
            <div class="col-md-9">
                <form action="{{ route('products.index') }}" class="d-flex" role="search">
                    <input class="form-control me-2" type="text" value="{{ request('keywords') }}" name="keywords"
                           placeholder="Search" aria-label="Search" autofocus>
                    <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-md-3">
                <a href="{{ route('products.create') }}"
                   class="btn btn-success w-100 mt-3 mt-md-0">
                    <i class="bi bi-plus"></i> New product
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check2-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endisset

        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                <th>ID</th>
                <th>Product Name</th>
                <th class="text-end">Price</th>
                <th class="text-end">Stock</th>
                <th class="text-end">Actions</th>
                </thead>
                <tbody>
                @forelse($list as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if (!empty($row->product_image))
                                    <img src="{{ asset('storage/' . $row->product_image) }}" height="70"
                                         alt="{{ $row->product_name }}">
                                @endif
                                <span>{{ $row->product_name }}</span>
                            </div>
                        </td>
                        <td class="text-end">{{ $row->price }}</td>
                        <td class="text-end">{{ $row->stock }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('products.edit', $row->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{$row->id}}Modal"
                                        class="btn btn-sm btn-danger btn-delete">
                                    <i class="bi bi-trash3"></i> Delete
                                </button>
                            </div>
                            <div class="modal fade" id="delete{{$row->id}}Modal" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="deleteForm" action="{{ route('products.destroy', $row->id) }}"
                                          method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete
                                                    Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                @method('DELETE')
                                                <p>You're gonna delete product <span
                                                        class="text-primary fw-bold">{{$row->product_name}}</span>.</p>
                                                <p>Are you sure?</p>

                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-danger">Yes, please!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="alert alert-warning" role="alert">
                                <i class="bi bi-exclamation-triangle-fill"></i> Found no product in the list.
                            </div>
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
@stop
