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
                    <form id="add_customer" action="{{ route('customers.edit', $data['customer']) }}" method="POST" enctype="multipart/form-data">
                        @csrf
						@method('PUT')
						<input type="hidden" name="id" id="id" value="{{ $data['customer']['id'] }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="name" value="{{ $data['customer']['name'] }}">
                                @error('name')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="customer email" value="{{ $data['customer']['email'] }}">
                                @error('email')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="customer phone" value="{{ $data['customer']['phone'] }}">
                                @error('phone')
                                <div class="text-red mt-2 text-sm">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="user address" value="{{ $data['customer']['address'] }}">
                                @error('address')
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
											<img src="{{ asset($data['customer']['image']) }}" alt="{{ $data['customer']['name'] }}" class="img-thumbnail">
											
										</div>
										<div class="col-8">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">Customer Image</label>
											
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
                            <button type="submit" class="btn btn-primary float-right">Edit Customer</button>
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
