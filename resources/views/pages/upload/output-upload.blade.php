@extends('layout.dashboard')
@section('title', 'history')
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
                    <div class="row">
                        <!-- Add Button Section -->
                        <div class="col-md-6 text-right"> <!-- Align button to the right -->
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addOutputModal">
                                <i class="fas fa-plus"></i> Tambah Supplier Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="outputTable" class="table table-striped" style="font-size: 14px;"> <!-- Decreased font size -->
                        <thead style="font-weight: bold; color: black;"> <!-- Bold and black text for header -->
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>BPM No.</th>
                                <th>Project No.</th>
                                <th>Description</th>
                                <th>Item No.</th>
                                <th>Item Description</th>
                                <th>Qty Out</th>
                                <th>Unit 1</th>
                                <th>Warehouse Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($outputs as $output)
                            <tr style="font-size: 13px; color: black;"> <!-- Decreased font size and black text -->
                                <td>{{ ($outputs->currentPage() - 1) * $outputs->perPage() + $loop->iteration }}</td>
                                <td>{{ $output->date }}</td>
                                <td>{{ $output->bpm_no }}</td>
                                <td>{{ $output->project_no }}</td>
                                <td class="truncate-text" data-toggle="popover" data-content="{{ $output->description }}">{{ $output->description }}</td>
                                <td>{{ $output->item_no }}</td>
                                <td class="truncate-text" data-toggle="popover" data-content="{{ $output->item_description }}">{{ $output->item_description }}</td>
                                <td>{{ $output->qty_out }}</td>
                                <td>{{ $output->unit }}</td>
                                <td>{{ $output->warehouse_name }}</td>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document"> <!-- Use modal-lg for large and modal-dialog-centered to center -->
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
                    <div class="row justify-content-center"> <!-- Center content -->
                        <div class="col-md-6"> <!-- Set column width to 6 -->
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
<!-- Include jQuery and DataTables JS from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- Initialize DataTables -->
<script>
   $(document).ready(function() {
    // Initialize DataTables as usual
    $('#outputTable').DataTable({
        "paging": true,           // Enable pagination
        "lengthChange": true,      // Enable length menu
        "searching": true,         // Enable the search bar
        "ordering": true,          // Enable column sorting
        "info": true,              // Show table info
        "autoWidth": false,        // Disable auto width calculation
        "pageLength": 10,          // Default page length
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ], // "All" option
        "scrollX": true            // Enable horizontal scroll
    });

    // Initialize Bootstrap Popovers for Description and Item Description
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',            // Show popover on hover (or you can use 'click')
        placement: 'top',             // Position of the popover (top of the element)
        html: true                    // Allows HTML in the popover content
    });
});

</script>

@endsection