@extends('layout.dashboard')
@section('title', 'Stock Out')
@section('content')

<!-- Session Alert -->
@if (session('success'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b><i class="fas fa-check-circle mr-1"></i></b>
        {{ session('success') }}
    </div>
</div>
@endif
@if (session('fail'))
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b><i class="fas fa-times-circle mr-1"></i></b>
        {{ session('fail') }}
    </div>
</div>
@endif
@if (session('err'))
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Error:</b>
        {{ session('err') }}
    </div>
</div>
@endif
@if (session('nothing'))
<div class="alert alert-warning alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b><i class="fas fa-exclamation-circle"></i></i> </b>
        {{ session('nothing') }}
    </div>
</div>
@endif

<section class="section">
    <div class="section-body">
        <!-- Title Text -->
        <div class="d-flex justify-content-between align-items-center p-2">
            <div>
                <h4>Transaction</h4>
                <h6 class="font-weight-light">Controls / <span class="font-weight-bold">Stock-Out - Transaction</span></h6>
            </div>
            <form action="{{ route('managing.division') }}" method="GET">
                <button class="btn d-flex align-items-center" style="background-color: white;" type="submit">
                    <i class="fas fa-exclamation-triangle" style="font-size: 16px; color: #007bff;"></i>
                    <span class="ml-2">Stock Clearance</span>
                </button>
            </form>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form - Stock Out <i class="fas fa-upload ml-2"></i></h4>
                    </div>
                    <form method="POST" action="{{ route('transaction.stockout.store') }}" class="needs-validation">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-0">
                                <div class="form-group col-md-6 col-12">
                                    <label>Select Product <span class="text-danger">*</span></label>
                                    <select id="product_id" class="form-control" name="product_id" tabindex="2" required>
                                        <option value="" disabled selected>Select a product...</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <input type="text" name="transaction_date" class="form-control datepicker" required>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Quantity <span class="text-danger">*</span></label>
                                    <input type="number" name="quantity" class="form-control" min="1" required>
                                </div>
                                <div class="form-group mb-0 pb-0 col-md-6 col-12">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right pt-0 mt-0">
                            <button class="btn btn-primary">Process Transaction</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection