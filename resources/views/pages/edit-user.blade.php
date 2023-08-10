@extends('layouts.app')

@section('title', 'Edit User')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit User</h2>

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
                        <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid
                                        @enderror"
                                        name="name" value="{{ old('name', $user->name) }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control @error('email') is-invalid
                                        @enderror"
                                        name="email" value="{{ old('email', $user->email) }}" required>
                                    @if ($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select
                                        class="form-control @error('role') is-invalid
                                        @enderror"
                                        name="role" required>
                                        <option value="">-- Select Role --</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                            User
                                        </option>
                                    </select>
                                    @if ($errors->has('role'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('role') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*(input new
                                            password)</span></label>
                                    <input type="password"
                                        class="form-control @error('password') is-invalid
                                        @enderror"
                                        name="password">
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
