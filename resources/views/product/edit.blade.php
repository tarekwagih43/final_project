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
						<h3 class="card-title">{{ $data['product']['title'] }} <small>Edit</small></h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id="add_product" action="{{ route('products.edit', $data['product']) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<input type="hidden" name="id" id="id" value="{{ $data['product']['id'] }}">
						<div class="card-body">
							<div class="form-group">
								<label for="title">product Title</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="product Title" value="{{ $data['product']['title'] }}">
								@error('title')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="price">product Price</label>
								<input type="number" name="price" class="form-control" id="price" placeholder="product price" value="{{ $data['product']['price'] }}">
								@error('price')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="category_id">Category</label>
								<select class="form-control" name="category_id" id="category_id">
									@if ($data['categories']->count())
									@foreach ($data['categories'] as $category)
									<option value="{{ $category->id }}" @if ($data['product']['category_id']==$category->id) selected @endif>{{ $category->title }}</option>
									@endforeach
									@else
									<option class="text-red"> NO Categories</option>
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea name="description" id="description" class="form-control" rows="3" placeholder="product description">{{ $data['product']['description'] }}</textarea>
								@error('description')
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
											<img src="{{ asset($data['product']['image']) }}" alt="{{ $data['product']['title'] }}" class="img-thumbnail">
											
										</div>
										<div class="col-8">
											<input type="file" class="custom-file-input" id="image" name="image">
											<label class="custom-file-label" for="image">Product Image</label>
											
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
							<button type="submit" class="btn btn-primary float-right">Edit product</button>
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
