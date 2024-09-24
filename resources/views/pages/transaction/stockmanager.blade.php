@extends('layout.dashboard')
@section('title', 'history')
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

<div class="p-2">
    <h4>Transaction</h4>
    <h6 class="font-weight-light">Controls / <span class="font-weight-bold">Stock Manager</span></h6>
</div>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Basic DataTables</h4>
                    <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                          
                            <button class="btn btn-success" style="border-radius: 2px;" type="button" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-file-csv"></i> Export Data</button>
                        
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Product Name</th>
                                    <th>Supplier</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Processed By</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Returns</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stocks as $stock)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$stock->product->product_name ?? 'N/A'}}</td> <!-- Handle possible null values -->
                                    <td>{{$stock->supplier->company_name ?? 'N/A'}}</td>
                                    <td>
                                        <div class="badge 
                                            @if($stock->status == 'in') badge-success
                                            @elseif($stock->status == 'out') badge-primary
                                            @elseif($stock->status == 'return') badge-warning
                                            @else badge-secondary
                                            @endif">
                                            {{$stock->status}}
                                        </div>
                                    </td>

                                    <td style="text-align: center;">{{$stock->user->username ?? 'N/A'}}</td> <!-- Handle possible null values -->
                                    <td>{{$stock->transaction_date}}</td>
                                    <td>{{$stock->description}}</td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="font-size:medium;">Data tidak tersedia</td> <!-- Updated colspan to 8 -->
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

@section('scripts')
<script>

</script>
@endsection