@extends('layouts.app-bootstrap')

@push('title', 'User Management')

@section('pageContent')
    <div class="container mt-4">
        <h3>User List</h3>

        <a href="{{ route('users.create') }}"
           class="btn btn-success mb-3">
            <i class="bi bi-plus"></i> New user
        </a>

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
                <th>Name</th>
                <th class="text-end">Roles</th>
                <th class="text-end">Actions</th>
                </thead>
                <tbody>
                @forelse($list as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td class="text-end">{{ implode(', ', $row->roles->pluck('name')->toArray()) }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('users.edit', $row->id) }}"
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
                                    <form class="deleteForm" action="{{ route('users.destroy', $row->id) }}"
                                          method="post">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                @method('DELETE')
                                                <p>You're gonna delete user <span
                                                        class="text-primary fw-bold">{{$row->name}}</span>.</p>
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
                        <td colspan="4">
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
