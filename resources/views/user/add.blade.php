@extends('layouts.app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data['page_title'] }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="add_usre" action="{{ route('users.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="user Title" value="{{ old('username') }}">
                                @error('username')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="user email" value="{{ old('email') }}"">
                                @error('email')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="user password" value="">
                                @error('password')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="user password confirm" value="">
                                @error('password_confirmation')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
							<div class="form-group">
								<label for="image">Image</label>
								<div class="input-group">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">User Image</label>
								</div>
								@error('image')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Add User</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
