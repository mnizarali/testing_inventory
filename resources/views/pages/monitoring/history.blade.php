@extends('layout.dashboard')
@section('title', 'history')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> History Transaction </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>History Penjualan Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Transaction ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:center;">Supplier</th>
                            <th>Transaction Date</th>
                            <th style="text-align:center;">Processed By</th>
                            <th>Description</th>
                            <th>Retun Reason</th>
                            <th>Created At</th>
                        </tr>
                        @forelse($histories as $history)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$history->transaction_id}}</td>
                            <td>{{$history->product}}</td>
                            <td>{{$history->quantity}}</td>
                            <td>{{$history->status}}</td>
                            <td>{{$history->supplier}}</td>
                            <td>{{$history->transaction_date}}</td>
                            <td>{{$history->create_by_user}}</td>
                            <td>{{$history->description}}</td>
                            <td>{{$history->return_reason}}</td>
                            <td>{{$history->created_at}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center" style="font-size:medium;">Data tidak tersedia</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
<script>

</script>
@endsection