@extends('layouts.template')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="text-center mb-3">
                <img src="{{ auth()->user()->avatar ? asset('storage/avatars/' . auth()->user()->avatar) : asset('default-avatar.png') }}"
                     class="rounded-circle img-fluid mb-3" style="width: 150px; height: 150px;" alt="Avatar">
                <h3 class="profile-username text-center">{{ auth()->user()->nama }}</h3>
                <p class="text-muted text-center">{{ auth()->user()->level }}</p>
            </div>

            <!-- Form to change profile picture -->
            <form action="{{ url('/profile/update_avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="avatar" id="avatar" class="form-control mb-2" required>
                    <button type="submit" class="btn btn-primary w-100">Ganti Foto Profil</button>
                </div>
            </form>
        </div>

        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#editdatadiri" data-toggle="tab">Edit Data Diri</a></li>
                        <li class="nav-item"><a class="nav-link" href="#editpw" data-toggle="tab">Edit Password</a></li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="editdatadiri">
                            <form action="{{ url('/profile/update_data_diri', Auth::user()->id) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->nama }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="level" class="col-sm-2 col-form-label">Level</label>
                                    <div class="col-sm-10">
                                        <select name="level_id" id="level" class="form-control" required>
                                            @foreach($levels as $level)
                                                <option value="{{ $level->id }}" {{ Auth::user()->level_id == $level->id ? 'selected' : '' }}>
                                                    {{ $level->level_nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="editpw">
                            <form action="{{ url('/profile/update_password') }}" method="POST" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-2 col-form-label">Password Lama</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="old_password" class="form-control" id="oldPassword" placeholder="Masukkan password lama" required>
                                        @if($errors->has('old_password'))
                                            <small class="text-danger">{{ $errors->first('old_password') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Masukkan password baru" required>
                                        @if($errors->has('new_password'))
                                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirmPassword" class="col-sm-2 col-form-label">Ulangi Password Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Ulangi password baru" required>
                                        @if($errors->has('confirm_password'))
                                            <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
@endsection
