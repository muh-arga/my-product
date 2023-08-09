@extends('layouts.app')

@section('title', 'Product')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">List Products</h2>

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
                                <div class="d-flex flex-md-row flex-column justify-content-between align-items-md-center p-3 my-3">
                                    <form action="{{ route('product.index') }}" method="GET" id="filter-form"
                                        class="col-md-4 col-12">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Search by Name | Unique ID | SKU"
                                                value={{ request()->get('search') }}>
                                            <button type="submit" class="input-group-text"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </form>
                                    @can('isAdmin')
                                        <a href="{{ route('product.create') }}"
                                            class="btn btn-primary mr-md-2 mr-0 mb-md-0 mb-2"><i class="fas fa-plus"></i>
                                            Create Product</a>
                                    @endcan
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Unique ID</th>
                                            <th>SKU</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->unique_id }}</td>
                                                <td>{{ $product->sku }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-start w-auto">
                                                        <div>
                                                            <a href="{{ route('product.show', ['product' => $product->id]) }}"
                                                                class="btn btn-sm btn-info">Detail</a>
                                                        </div>
                                                        @can('isAdmin')
                                                            <div class="mx-2">
                                                                <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                                                    class="btn btn-sm btn-warning">Edit</a>
                                                            </div>
                                                            <div>
                                                                <form id="form{{ $product->id }}"
                                                                    action="{{ route('product.delete', ['product' => $product->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-sm btn-danger"
                                                                        data-confirm="Delete product?|The product will be deleted. Do you want to continue?"
                                                                        data-confirm-yes="submitForm({{ $product->id }})">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0 d-flex flex-wrap">
                                        <li class="page-item {{ $products->currentPage() == 1 ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $products->path() . '?page=' . $products->currentPage() - 1 }}"
                                                tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                        </li>
                                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                                            @if ($i == 1)
                                                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $products->path() . '?page=' . $i }}">{{ $i }}<span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                            @else
                                                <li
                                                    class="page-item  {{ $products->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $products->path() . '?page=' . $i }}">{{ $i }}</a>
                                                </li>
                                            @endif
                                        @endfor
                                        <li
                                            class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                                            <a class="page-link"
                                                href="{{ $products->path() . '?page=' . $products->currentPage() + 1 }}"><i
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
            $(`#form${id}`).submit();
        }

        $('#filter').change(function() {
            $('#filter-form').submit();
        });
    </script>
@endpush
