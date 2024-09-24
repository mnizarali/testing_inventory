@extends('layout.dashboard')
@section('title', 'Division')
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

<div class="d-flex justify-content-between align-items-center p-2">
    <div>
        <h4>Managing</h4>
        <h6 class="font-weight-light">Data & Account / <span class="font-weight-bold">Divisions</span></h6>
    </div>
    <form action="{{ route('managing.department') }}" method="GET">
        <button class="btn d-flex align-items-center" style="background-color: white;" type="submit">
            <i class="fas fa-arrow-alt-circle-left" style="font-size: 16px; color: #007bff;"></i>
            <span class="ml-2">Back to Department</span>
        </button>
    </form>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Divisions Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">

                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addDivisionModal"><i class="fas fa-plus"></i> Tambah Divisi Baru</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Division</th>
                            <th>Department</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse ($divisions as $division)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$division->division_name}}</td>
                            <td>{{$division->department->department_name}}</td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editDivisionModal{{$division->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('managing.division.delete', $division->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this Division?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Modal  -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="editDivisionModal{{$division->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Division</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('managing.division.edit', $division->id) }}" class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Division Name<span class="text-danger">*</span></label>
                                                <input id="name" class="form-control" name="division_name" tabindex="1" value="{{$division->division_name}}" type="text" required autofocus>
                                                <div class="invalid-feedback">
                                                    Silahkah isi Division
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="department_id">Department<span class="text-danger">*</span></label>
                                                <select id="department_id" class="form-control" name="department_id" tabindex="2" required>
                                                    <option value="{{ $division->department_id }}" selected>{{ $division->department->department_name }}</option>
                                                    @foreach($departments as $department)
                                                    @if($department->department_name != $division->department->department_name)
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            {{-- <div class="form-group">
                                                    <div class="d-block">
                                                        <label for="stock" class="control-label">Stock</label>
                                                    </div>
                                                    <input id="stock" class="form-control" name="stok" tabindex="2" type="number"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        please fill in product stock
                                                    </div>
                                                </div> --}}
                                        </div>
                                        <div class="modal-footer bg-whitesmoke br">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Category Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addDivisionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('managing.division.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="division_name">Division Name<span class="text-danger">*</span></label>
                        <input id="division_name" class="form-control" name="division_name" tabindex="1" type="text" required placeholder="Division name..." autofocus>
                        <div class="invalid-feedback">
                            Silahkan isi category
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="department_id">Department<span class="text-danger">*</span></label>
                        <select id="department_id" class="form-control" name="department_id" tabindex="2" required>
                            <option value="" disabled selected>Select a department...</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{$department->department_name }}</option>
                            @endforeach
                        </select>

                        <div class="invalid-feedback">
                            Silahkan isi department
                        </div>
                    </div>

                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection