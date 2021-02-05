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
						<h3 class="card-title">Add product</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id="add_product" action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('POST')
						<div class="card-body">
							<div class="form-group">
								<label for="title">product Title</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="product Title" value="{{ old('title') }}">
								@error('title')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="price">product Price</label>
								<input type="number" name="price" class="form-control" id="price" placeholder="product price" value="{{ old('price') }}">
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
									<option value="{{ $category->id }}">{{ $category->title }}</option>
									@endforeach
									@else
									<option class="text-red"> NO Categories</option>
									@endif
								</select>
							</div>
							<div class="form-group">
								<label for="description">Description</label>
								<textarea name="description" id="description" class="form-control" rows="3" placeholder="product description">{{ old('description') }}</textarea>
								@error('description')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="form-group">
								<label for="image">Image</label>
								<div class="input-group">
										<input type="file" class="custom-file-input" id="image" name="image">
										<label class="custom-file-label" for="image">Product Image</label>
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
							<button type="submit" class="btn btn-primary float-right">Add product</button>
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
