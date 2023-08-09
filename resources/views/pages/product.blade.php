@extends('layouts.app')

@section('title', 'Product Detail')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Detail Product</h2>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="d-flex flex-md-row flex-column">
                                    <div class="col-12 mt-md-0 mt-3">
                                        <div class="title">
                                            <div class="d-flex flex-row py-2 mb-4">
                                                <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left mr-2"></i>Back</a>
                                                @can('isAdmin')
                                                    <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                                        class="btn btn-warning mx-2">Edit</a>
                                                    <form id="form"
                                                        action="{{ route('product.delete', ['product' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            data-confirm="Delete product?|Do you want to continue?"
                                                            data-confirm-yes="submitForm()">Delete</button>
                                                    </form>
                                                @endcan
                                            </div>
                                            <h3>{{ $product->name }}</h3>
                                            <div
                                                class="d-flex flex-md-row flex-column justify-content-between col-md-6 col-12 p-0 mb-4">
                                                <span>Unique ID: {{ $product->unique_id }}</span>
                                                <span class="mt-md-0 mt-3">SKU: {{ $product->sku }}</span>
                                            </div>
                                            <div class="description">
                                                <h6>Description</h6>
                                                <p>{{ $product->description }}</p>
                                            </div>
                                            <div class="specification">
                                                <h6>Specification</h6>
                                                <p>{{ $product->specification }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        function submitForm() {
            document.getElementById("form").submit();
        }
    </script>
@endpush
