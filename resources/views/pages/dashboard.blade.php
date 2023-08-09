@extends('layouts.app')

@section('title', 'Dashboard')

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                @cannot('isUser')
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>User</h4>
                                </div>
                                <div class="card-body">
                                    {{ count($users) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endcannot
                @cannot('isSuperAdmin')
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Product</h4>
                                </div>
                                <div class="card-body">
                                    {{ count($products) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endcannot
            </div>
        </section>
    </div>
@endsection
