@extends('layouts.app')

@section('content')

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			@if(Session::get('success'))
			<div class="col-md-12">
				<div class="text-green mt-2 mb-2 text-lg text-center">
					{{ Session::get('success') }}
				</div>
			</div>
			@endif
			<!-- left column -->
			<div class="col-md-12">
				<!-- jquery validation -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">{{ $data['user']['name'] }} <small>Edit</small></h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id="add_users" action="{{ route('users.edit', $data['user']) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" name="id" id="id" value="{{ $data['user']['id'] }}">
						<div class="card-body">
							<div class="form-group">
								<label for="title">Name</label>
								<input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{ $data['user']['name'] }}">
								@error('name')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" id="username" placeholder="user Title" value="{{ $data['user']['username'] }}">
								@error('username')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="user email" value="{{ $data['user']['email'] }}"">
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
									<div class="d-flex justify-content-between align-items-center">
										<div class="col-4">
											<img src="{{ asset($data['user']['image']) }}" alt="{{ $data['user']['name'] }}" class="img-thumbnail">
											
										</div>
										<div class="col-8">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">User Image</label>
											
										</div>
									</div>
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
							<button type="submit" class="btn btn-primary float-right">Edit User</button>
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
