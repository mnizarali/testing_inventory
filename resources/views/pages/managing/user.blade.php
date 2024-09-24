@extends('layout.dashboard')
@section('title', 'Users Account')
@section('content')
<div class="p-2">
    <h4>Managing</h4>
    <h6 class="font-weight-light">Data & Account / <span class="font-weight-bold"> Users Account </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Users Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a href="" class="btn btn-primary" style="background-color: #572D0C"><i class="fas fa-plus"></i> New Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            @if($user->role === 'admin')
                            <td>
                                <div class="badge badge-success">Admin</div>
                            </td>
                            @else
                            <td>
                                <div class="badge badge-warning">General User</div>
                            </td>
                            @endif
                            <td>
                                @if($user->last_login)
                                    @php
                                        $lastLogin = \Carbon\Carbon::parse($user->last_login);
                                    @endphp

                                    @if ($lastLogin->diffInMinutes() < 1)
                                        Just Now
                                    @else
                                        {{ $lastLogin->diffForHumans() }}
                                    @endif
                                @else
                                    Never Logged In
                                @endif
                            </td>
                            <td style="display:flex; align-items:center; justify-content:center;">
                                <!-- Edit Button -->
                                <button class="btn" style="width: 35px; height: 35px; padding: 0; display: flex; align-items: center; justify-content: center; border-radius: 15%; margin:3px; background-color:lightgreen;" type="button" data-toggle="modal" data-target="#editUserModal{{$user->id}}">
                                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                                </button>
                                <!-- Delete Button -->
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-danger" style="margin: 3px;width: 35px; height: 35px; padding:0; " onclick="return confirm('Are you sure you want to delete this User?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" tabindex="-1" role="dialog" id="editUserModal{{$user->id}}">
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
                                                <label for="product_name">Nama User<span class="text-danger">*</span></label>
                                                <input id="product_name" class="form-control" name="name" tabindex="1" value="{{ $user->name }}" type="text" required autofocus>
                                                <div class="invalid-feedback">
                                                    Silahkah isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Email<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="price" class="form-control" name="email" tabindex="2" value="{{ $user->email }}" type="email" required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Password<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="price" class="form-control" name="password" tabindex="2" value="{{ $user->password }}" type="password" required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Role<span class="text-danger">*</span></label>
                                                </div>
                                                <select name="role" class="input-group mb-3 border">
                                                    <option value="{{$user->role}}"> {{$user->role}}</option>
                                                    <option value="employee" >Employee </option>
                                                    <option value="admin">Admin</option>
                                                </select>
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
                        @endforeach
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