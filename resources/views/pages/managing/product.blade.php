
@extends('layout.dashboard')
@section('title', 'Product')
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
    <h4>Managing</h4>
    <h6 class="font-weight-light">Data & Account / <span class="font-weight-bold">Product</span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Stok</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                          
                            <button class="btn btn-success" style="border-radius: 2px;" type="button" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-file-csv"></i> Export Data</button>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addProductModal"><i class="fas fa-plus"></i> Tambah Produk Baru</button>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Photo</th>
                            <th>Product Name</th>
                            <th style="text-align: center;">Stock</th>
                            <th>Code</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @forelse($products as $product)
                        <tr>
                            <td><img src="{{ asset('uploads/product/img/' . $product->img) }}" alt="image" style="height: 50px; width:auto;"></td>
                            <td>{{$product->product_name}}</td>
                            <td style="text-align: center;">{{$product->stock}}</td>
                            <td>{{$product->code}}</td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editProductModal">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('managing.product.delete', $product->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" tabindex="-1" role="dialog" id="editStockModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Unit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="" class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="stock" class="control-label">Masukan Unit<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="stock" class="form-control" name="stock" tabindex="2" type="number" required>
                                                <div class="invalid-feedback">
                                                    please fill in unit product
                                                </div>
                                                <small><b></b>Isi dengan teliti</small>
                                            </div>

                                        </div>
                                        <div class="modal-footer bg-whitesmoke br">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" tabindex="-1" role="dialog" id="editProdukModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="" class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="product_name">Nama Produk<span class="text-danger">*</span></label>
                                                <input id="product_name" class="form-control" name="name" tabindex="1" value="" type="text" required autofocus>
                                                <div class="invalid-feedback">
                                                    Silahkah isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Harga<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="price" class="form-control" name="price" tabindex="2" value="" type="number" required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

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
                            <td colspan="2" class="text-center" style="font-size:medium;">Data tidak tersedia</td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addProductModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('managing.product.store') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_name">Nama Produk<span class="text-danger">*</span></label>
                        <input id="product_name" class="form-control" name="product_name" tabindex="1" type="text" required autofocus>
                        <div class="invalid-feedback">
                            Silahkan isi nama produk
                        </div>
                    </div>

                    <div class="form-group">
                        <input id="img" class="form-control" name="img" tabindex="2" type="file" required>
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