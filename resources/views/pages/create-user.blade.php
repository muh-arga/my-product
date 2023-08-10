@extends('layouts.app')

@section('title', 'Create User')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create User</h2>

                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('failed') }}
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid
                                        @enderror"
                                        name="name" value="{{ old('name') }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid
                                        @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                @can('isSuperAdmin')
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select
                                            class="form-control @error('role') is-invalid
                                        @enderror"
                                            name="role" required>
                                            <option value="">-- Select Role --</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>
                                                User
                                            </option>
                                        </select>
                                        @if ($errors->has('role'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('role') }}
                                            </div>
                                        @endif
                                    </div>
                                @endcan
                                <div class="form-group">
                                    <label for="password" class="d-block">Password</label>
                                    <input id="password" type="password"
                                        class="form-control pwstrength @error('password') is-invalid @enderror"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
