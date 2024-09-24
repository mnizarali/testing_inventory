@extends('layout.dashboard')
@section('title', 'Supplier Category')
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
        <h6 class="font-weight-light">Data & Account / Suppliers / <span class="font-weight-bold">Supplier Categories</span></h6>
    </div>
    <form action="{{ route('managing.supplier') }}" method="GET">
        <button class="btn d-flex align-items-center" style="background-color: white;" type="submit">
            <i class="fas fa-arrow-alt-circle-left" style="font-size: 16px; color: #007bff;"></i>
            <span class="ml-2">Back to Supplier</span>
        </button>
    </form>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Stok</h4>
                <div class="card-header-form">
                    <div class="input-group">
                    <div class="input-group-btn">
                          
                          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addCategoryModal"><i class="fas fa-plus"></i> Tambah Category Supplier</button>
                      
                      </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editCategoryModal{{$category->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('managing.supplier.category.delete', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Category Modal  -->
                        <div class="modal fade" tabindex="-1" role="dialog" id="editCategoryModal{{$category->id}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('managing.supplier.category.edit', $category->id)}}" class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Category Name<span class="text-danger">*</span></label>
                                                <input id="name" class="form-control" name="name" tabindex="1" value="{{$category->name}}" type="text" required autofocus>
                                                <div class="invalid-feedback">
                                                    Silahkah isi category
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="description" class="control-label">Description<span class=""></span></label>
                                                </div>
                                                <input id="description" class="form-control" name="description" tabindex="2" value="{{$category->description}}" type="text">
                                                <div class="invalid-feedback">
                                                    Silahkan isi description
                                                </div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="addCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supllier Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('managing.supplier.category.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category<span class="text-danger">*</span></label>
                        <input id="name" class="form-control" name="name" tabindex="1" type="text" required placeholder="Category name..." autofocus>
                        <div class="invalid-feedback">
                            Silahkan isi category
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="description" class="control-label">Description<span class="text-danger"></span></label>
                        </div>
                        <textarea id="description" class="form-control" name="description" tabindex="2" type="number" placeholder="Silakan isi catatan"></textarea>
                        <div class="invalid-feedback">
                            Silahkan isi catatan
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