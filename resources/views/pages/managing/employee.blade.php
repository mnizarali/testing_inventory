@extends('layout.dashboard')
@section('title', 'Employees')
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

<!-- Title Text -->
<div class="d-flex justify-content-between align-items-center p-2">
    <div>
        <h4>Managing</h4>
        <h6 class="font-weight-light">Data & Account / <span class="font-weight-bold">Employees</span></h6>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Employees Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">

                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addEmployeeModal"><i class="fas fa-plus"></i> Tambah Employee</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Department</th>
                            <th>Division</th>
                            <th>Position</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse($employees as $employee)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$employee->fullname}}</td>
                            <td>{{$employee->email}}</td>
                            <td>{{$employee->phone_number}}</td>
                            <td>{{$employee->department->department_name}}</td>
                            <td>{{$employee->division->division_name}}</td>
                            <td>{{$employee->position}}</td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editEmployeeModal{{$employee->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('managing.employee.delete', $employee->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this supplier?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Supplier Edit Modal -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="editEmployeeModal{{$employee->id}}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Employee Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('managing.employee.edit', $employee->id) }}" class="needs-validation" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fullname">Full Name<span class="text-danger">*</span></label>
                                                        <input id="fullname" class="form-control" name="fullname" tabindex="1" type="text" placeholder="Isi dengan nama lengkap.." required value="{{ $employee->fullname }}" autofocus>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi nama lengkap employee
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="control-label">Email<span class="text-danger"></span></label>
                                                        <input id="email" class="form-control" name="email" tabindex="3" type="text" placeholder="Isi dengan email.." value="{{$employee->email}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi dengan email
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone_number" class="control-label">Phone Number<span class="text-danger"></span></label>
                                                        <input id="phone_number" class="form-control" name="phone_number" tabindex="5" type="text" placeholder="Isi dengan no telpon" value="{{$employee->phone_number}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi nomor telpon
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kolom Kanan -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="department_id">Department<span class="text-danger">*</span></label>
                                                        <select id="department_id" class="form-control" name="department_id" tabindex="2" required>
                                                            <option value="{{$employee->department->id}}" selected>{{$employee->department->department_name}}</option>
                                                            @foreach($departments as $department)
                                                            @if($department->department_name != $employee->department->department_name)
                                                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi department
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="division_id">Division<span class="text-danger">*</span></label>
                                                        <select id="division_id" class="form-control" name="division_id" tabindex="2" required>
                                                            <option value="{{$employee->division->id}}" selected>{{$employee->division->division_name}}</option>
                                                            @foreach($divisions as $division)
                                                            @if($division->division_name != $employee->division->division_name)
                                                            <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi kategori supplier
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="position">Position<span class="text-danger"></span></label>
                                                        <input id="position" class="form-control" name="position" tabindex="6" type="text" placeholder="Isi dengan posisi employee" value="{{$employee->position}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi posisi employee
                                                        </div>
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

<!-- Employee Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addEmployeeModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('managing.employee.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname">Full Name<span class="text-danger">*</span></label>
                                <input id="fullname" class="form-control" name="fullname" tabindex="1" type="text" placeholder="Isi dengan nama lengkap.." required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan isi nama lengkap employee
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="control-label">Email<span class="text-danger"></span></label>
                                <input id="email" class="form-control" name="email" tabindex="3" type="text" placeholder="Isi dengan email..">
                                <div class="invalid-feedback">
                                    Silahkan isi dengan email
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="control-label">Phone Number<span class="text-danger"></span></label>
                                <input id="phone_number" class="form-control" name="phone_number" tabindex="5" type="text" placeholder="Isi dengan no telpon">
                                <div class="invalid-feedback">
                                    Silahkan isi nomor telpon
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department_id">Department<span class="text-danger">*</span></label>
                                <select id="department_id" class="form-control" name="department_id" tabindex="2" required>
                                    <option value="" disabled selected>Select a Department...</option>
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi department
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="division_id">Division<span class="text-danger">*</span></label>
                                <select id="division_id" class="form-control" name="division_id" tabindex="2" required>
                                    <option value="" disabled selected>Select a division...</option>
                                    @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi kategori supplier
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="position">Position<span class="text-danger"></span></label>
                                <input id="position" class="form-control" name="position" tabindex="6" type="text" placeholder="Isi dengan posisi employee">
                                <div class="invalid-feedback">
                                    Silahkan isi posisi employee
                                </div>
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