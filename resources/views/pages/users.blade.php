@extends('layouts.app')

@section('title', 'User')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>User</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">List Users</h2>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div
                                    class="d-flex flex-md-row flex-column justify-content-between align-items-md-center p-3 my-3">
                                    <form action="{{ route('user.index') }}" method="GET" id="filter-form"
                                        class="col-md-4 col-12">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search by Name | Email" value={{ request()->get('search') }}>
                                            <button type="submit" class="input-group-text"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                    <a href="{{ route('user.create') }}"
                                        class="btn btn-primary mr-md-2 mr-0 mb-md-0 mb-2"><i class="fas fa-plus"></i>
                                        Create User</a>
                                </div>
                                <div class="table-responsive col-12">
                                    <table class="table-striped table w-100">
                                        <tr>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>role</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($users as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        @can('isAdmin')
                                                            <div>
                                                                <form id="roleForm{{ $user->id }}"
                                                                    action="{{ route('user.update.role', ['user' => $user]) }}"
                                                                    method="GET">
                                                                    @csrf
                                                                    <button class="btn btn-sm btn-warning"
                                                                        data-confirm="Update user role?|change user role to admin. Do you want to continue?"
                                                                        data-confirm-yes="submitFormRole({{ $user->id }})">Change
                                                                        to
                                                                        Admin</button>
                                                                </form>
                                                            </div>
                                                        @endcan
                                                        @can('isSuperAdmin')
                                                            <div class="mx-2">
                                                                <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                                                                    class="btn btn-sm btn-warning">Edit</a>
                                                            </div>
                                                            <div>
                                                                <form id="form{{ $user->id }}"
                                                                    action="{{ route('user.delete', ['user' => $user]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-danger"
                                                                        data-confirm="Delete user?|The user will be deleted. Do you want to continue?"
                                                                        data-confirm-yes="submitForm({{ $user->id }})">Delete</button>
                                                                </form>
                                                            </div>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0 d-flex flex-wrap">
                                        <li class="page-item {{ $users->currentPage() == 1 ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $users->path() . '?page=' . $users->currentPage() - 1 }}"
                                                tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                                            @if ($i == 1)
                                                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $users->path() . '?page=' . $i }}">{{ $i }}<span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                            @else
                                                <li class="page-item  {{ $users->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $users->path() . '?page=' . $i }}">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endfor
                                        <li
                                            class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $users->path() . '?page=' . $users->currentPage() + 1 }}"><i
                                                    class="fas fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        function submitForm(id) {
            document.getElementById(`form${id}`).submit();
        }

        function submitFormRole(id) {
            document.getElementById(`roleForm${id}`).submit();
        }
    </script>
@endpush
