@extends('layout.dashboard')
@section('title', 'Dashboard - Summary')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> Summary </span></h6>
</div>
<div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">Stock Statistics - 
                    <div class="dropdown d-inline">
                      <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">All</a>
                      <ul class="dropdown-menu dropdown-menu-sm">
                        <li class="dropdown-title">Select Month</li>
                        <li><a href="#" class="dropdown-item" active>All</a></li>
                        <li><a href="#" class="dropdown-item">January</a></li>
                        <li><a href="#" class="dropdown-item">February</a></li>
                        <li><a href="#" class="dropdown-item">March</a></li>
                        <li><a href="#" class="dropdown-item">April</a></li>
                        <li><a href="#" class="dropdown-item">May</a></li>
                        <li><a href="#" class="dropdown-item">June</a></li>
                        <li><a href="#" class="dropdown-item">July</a></li>
                        <li><a href="#" class="dropdown-item">August</a></li>
                        <li><a href="#" class="dropdown-item">September</a></li>
                        <li><a href="#" class="dropdown-item">October</a></li>
                        <li><a href="#" class="dropdown-item">November</a></li>
                        <li><a href="#" class="dropdown-item">December</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$stockin}}</div>
                      <div class="card-stats-item-label">Stock In</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$stockout}}</div>
                      <div class="card-stats-item-label">Stock Out</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">{{$stockreturn}}</div>
                      <div class="card-stats-item-label">Returned</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaction</h4>
                  </div>
                  <div class="card-body">
                    {{$total_transaction}}
                  </div>
                </div>
              </div>
            </div>
            
         
@endsection

@section('scripts')
<script>

</script>
@endsection