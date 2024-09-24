@extends('layout.dashboard')
@section('title', 'History')
@section('content')
<div class="p-2">
    <h4>Output Upload</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> Output Upload </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Temporary Output</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addOutputModal">
                                <i class="fas fa-plus"></i> Tambah Supplier Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="outputTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>BPM No.</th>
                                <th>Project No.</th>
                                <th>Description</th>
                                <th>Item No.</th>
                                <th>Item Description</th>
                                <th>Qty Out</th>
                                <th>Unit</th>
                                <th>Warehouse Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($outputs as $output)
                            <tr>
                                <td>{{$output->date}}</td>
                                <td>{{$output->bpm_no}}</td>
                                <td>{{$output->project_no}}</td>
                                <td>{{$output->description}}</td>
                                <td>{{$output->item_no}}</td>
                                <td>{{$output->item_description}}</td>
                                <td>{{$output->qty_out}}</td>
                                <td>{{$output->unit}}</td>
                                <td>{{$output->warehouse_name}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center" style="font-size:medium;">Data tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Supplier Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addOutputModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('output.import') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name<span class="text-danger">*</span></label>
                                <input type="file" name="file" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Process</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include jQuery and DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script>
    $(document).ready(function() {
        // Initialize DataTable with horizontal scroll enabled
        $('#outputTable').DataTable({
            scrollX: true, // Enable horizontal scrolling
            paging: true,
            searching: true,
            ordering: true,
            lengthChange: true,
            pageLength: 10,
            responsive: true
        });
    });
</script>
@endsection
