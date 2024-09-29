@extends('layouts.app-bootstrap')

@push('title', 'New user')

@section('pageContent')
    <div class="container mt-4">
        <h3 class="mb-3">New user</h3>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check2-circle"></i> {{ session('success') }}
            </div>
        @endisset

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <label class="fw-bold">What role(s) for this user?</label>
                    <div class="is-invalid">
                        @foreach(\App\Models\Role::all() as $role)
                            <div class="mb-3 form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" id="role_{{ $role->id }}" name="roles[]" value="{{ $role->name }}">
                                <label class="form-check-label"
                                       for="role_{{ $role->id }}">{{ \Illuminate\Support\Str::title($role->name) }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-triangle"></i> {{ $errors->first('roles') }}
                    </div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-floating mt-3 mt-lg-0">
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               placeholder="Name of user"
                               value="{{ old('name') }}" autofocus>
                        <label for="name">Name of user</label>
                        @error('name')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mt-3 mt-lg-0">
                        <input type="text"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               placeholder="Email"
                               value="{{ old('email') }}">
                        <label for="email">Email</label>
                        @error('email')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mt-3">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password"
                               name="password"
                               placeholder="Password"
                               value="">
                        <label for="password">Password to login</label>
                        @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-triangle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mt-3">
                        <input type="password"
                               class="form-control"
                               id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Password again"
                               value="">
                        <label for="password">Password again</label>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-3 justify-content-end">
                <button type="submit" class="btn btn-success me-3">
                    <i class="bi bi-download"></i> Save
                </button>
                <a href="{{ route('users.index') }}"
                   class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Back</a>
            </div>
        </form>
    </div>
@stop
