@extends('layout.dashboard')
@section('title', 'Departments')
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
        <h6 class="font-weight-light">Data & Account /  <span class="font-weight-bold">Departments</span></h6>
    </div>
    <form action="{{ route('managing.division') }}" method="GET">
        <button class="btn d-flex align-items-center" style="background-color: white;" type="submit">
            <i class="fas fa-box" style="font-size: 16px; color: #007bff;"></i>
            <span class="ml-2">Manage Division</span>
        </button>
    </form>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Departments Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">

                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addDepartmentModal"><i class="fas fa-plus"></i> Tambah Department Baru</button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Department</th>
                            <th>Created At</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse($departments as $department)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$department->department_name}}</td>
                            <th>{{$department->created_at}}</th>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editDepartmentModal{{$department->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('managing.department.delete', $department->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this supplier?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Supplier Edit Modal -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="editDepartmentModal{{$department->id}}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Supplier</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('managing.department.edit', $department->id) }}" class="needs-validation" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="department_name">Department Name<span class="text-danger">*</span></label>
                                                        <input id="department_name" class="form-control" name="department_name" tabindex="1" type="text" placeholder="Isi dengan nama perusahaan supplier.." required value="{{$department->department_name}}" autofocus>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi nama perusahaan supplier
                                                        </div>
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
                        @empty
                        <tr>
                            <td colspan="2" class="text-center" style="font-size:medium;">Data tidak tersedia</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Department Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addDepartmentModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('managing.department.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="department_name">Department Name<span class="text-danger">*</span></label>
                                <input id="department_name" class="form-control" name="department_name" tabindex="1" type="text" placeholder="Isi dengan nama department" required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan isi nama department
                                </div>
                            </div>
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