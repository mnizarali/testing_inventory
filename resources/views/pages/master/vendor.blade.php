@extends('layout.dashboard')
@section('title', 'Vendor')
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
        <h4>Master Data</h4>
        <h6 class="font-weight-light">Master Data / <span class="font-weight-bold">Vendor</span></h6>
    </div>
    <form action="" method="GET">
        <button class="btn d-flex align-items-center" style="background-color: white;" type="submit">
            <i class="fas fa-box" style="font-size: 16px; color: #007bff;"></i>
            <span class="ml-2">Manage Category</span>
        </button>
    </form>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Table Vendor</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">

                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addSupplierModal"><i class="fas fa-plus"></i> Tambah Vendor Baru</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Company</th>
                            <th>Category</th>
                            <th>Contact Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse($suppliers as $supplier)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$supplier->company_name}}</td>
                            <td>{{$supplier->category}}</td>
                            <td>{{$supplier->contact_name}}</td>
                            <td>{{$supplier->phone_number}}</td>
                            <td>{{$supplier->address}}</td>
                            <td>{{$supplier->description}}</td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editSupplierModal{{$supplier->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('master.vendor.delete', $supplier    ->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this supplier?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Supplier Edit Modal -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="editSupplierModal{{$supplier->id}}">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Vendor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('master.vendor.edit', $supplier->id) }}" class="needs-validation" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <!-- Kolom Kiri -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name<span class="text-danger">*</span></label>
                                                        <input id="company_name" class="form-control" name="company_name" tabindex="1" type="text" placeholder="Isi dengan nama perusahaan supplier.." required value="{{$supplier->company_name}}" autofocus>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi nama perusahaan supplier
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="contact_name" class="control-label">Contact Name<span class="text-danger"></span></label>
                                                        <input id="contact_name" class="form-control" name="contact_name" tabindex="3" type="text" placeholder="Isi dengan nama kontak.." value="{{$supplier->contact_name}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi nama penanggung jawab supplier
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address" class="control-label">Address<span class="text-danger"></span></label>
                                                        <input id="address" class="form-control" name="address" tabindex="5" type="text" placeholder="Isi dengan alamat supplier" value="{{$supplier->address}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi alamat supplier
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Kolom Kanan -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="category">Category<span class="text-danger">*</span></label>
                                                        <select id="category" class="form-control" name="category" tabindex="2" required>
                                                            <option value="{{ $supplier->category }}" selected>{{ $supplier->category }}</option>
                                                            @foreach($categories as $category)
                                                            @if($category->name != $supplier->category)
                                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>

                                                        <div class="invalid-feedback">
                                                            Silahkan isi kategori supplier
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone_number">Phone Number<span class="text-danger"></span></label>
                                                        <input id="phone_number" class="form-control" name="phone_number" tabindex="4" type="text" placeholder="Isi dengan no telpon supplier" value="{{$supplier->phone_number}}">
                                                        <div class="invalid-feedback">
                                                            Silahkan isi no telpon supplier
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="description">Description<span class="text-danger"></span></label>
                                                        <textarea id="description" class="form-control" name="description" tabindex="6" type="text" placeholder="Isi dengan catatan">{{$supplier->description}}</textarea>
                                                        <div class="invalid-feedback">
                                                            Silahkan isi catatan
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
<!-- Supplier Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addSupplierModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Vendor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('master.vendor.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="company_name">Company Name<span class="text-danger">*</span></label>
                                <input id="company_name" class="form-control" name="company_name" tabindex="1" type="text" placeholder="Isi dengan nama perusahaan supplier.." required autofocus>
                                <div class="invalid-feedback">
                                    Silahkan isi nama perusahaan supplier
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_name" class="control-label">Contact Name<span class="text-danger"></span></label>
                                <input id="contact_name" class="form-control" name="contact_name" tabindex="3" type="text" placeholder="Isi dengan nama kontak..">
                                <div class="invalid-feedback">
                                    Silahkan isi nama penanggung jawab supplier
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="control-label">Address<span class="text-danger"></span></label>
                                <input id="address" class="form-control" name="address" tabindex="5" type="text" placeholder="Isi dengan alamat supplier">
                                <div class="invalid-feedback">
                                    Silahkan isi alamat supplier
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category">Category<span class="text-danger">*</span></label>
                                <select id="category" class="form-control" name="category" tabindex="2" required>
                                    <option value="" disabled selected>Select a category...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan isi kategori supplier
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number<span class="text-danger"></span></label>
                                <input id="phone_number" class="form-control" name="phone_number" tabindex="4" type="text" placeholder="Isi dengan no telpon supplier">
                                <div class="invalid-feedback">
                                    Silahkan isi no telpon supplier
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description<span class="text-danger"></span></label>
                                <textarea id="description" class="form-control" name="description" tabindex="6" type="text" placeholder="Isi dengan catatan"></textarea>
                                <div class="invalid-feedback">
                                    Silahkan isi catatan
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