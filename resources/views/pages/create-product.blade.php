@extends('layouts.app')

@section('title', 'Create Product')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create Product</h2>

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
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
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
                                    <label for="sku">SKU</label>
                                    <input type="text"
                                        class="form-control @error('sku') is-invalid
                                        @enderror"
                                        name="sku" value="{{ old('sku') }}" required>
                                    @if ($errors->has('sku'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('sku') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('description') is-invalid
                                        @enderror"
                                        name="description" required>{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Specification</label>
                                    <textarea class="form-control @error('specification') is-invalid
                                        @enderror"
                                        name="specification" required>{{ old('specification') }}</textarea>
                                    @if ($errors->has('specification'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('specification') }}
                                        </div>
                                    @endif
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
