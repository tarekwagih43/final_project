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
			@if(Session::get('error'))
			<div class="col-md-12">
				<div class="text-danger mt-2 mb-2 text-lg text-center">
					{{ Session::get('error') }}
				</div>
			</div>
			@endif
			<div class="col-md-12">
				<div class="card">
					<div class="card-header justify-content-between align-items-center">
						<h3 class="card-title p-1 mt-auto mb-auto">{{ $data['page_title'] }}</h3>
						<h6 class="float-right"><a href="{{ route('products.add') }}" class="btn btn-primary"> Add Product</a></h6>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 10%">#</th>
									<th style="width: 30%">Image</th>
									<th style="width: 20%">Title</th>
									<th style="width: 20%">Category</th>
									<th style="width: 20%" class="sr-only">Action</th>
								</tr>
							</thead>
							<tbody class="align-items-center">
								@if ($data['products']->count())
								@foreach ($data['products'] as $product)
								<tr scope="row">
									<td>{{ $product->id }}</td>
									<td style="max-height: 300px;"> <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="d-inline-block img-thumbnail"> </td>
									<td>{{ $product->title }}</td>
									<td>{{ $product->category_title }}</td>
									<td><a href="{{ route('products.edit', $product->id) }}" class="d-inline"><span class="btn btn-sm btn-success mr-3 ">Edit</span></a>
										<form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
											@csrf
											@method('delete')
											<input type="hidden" name="id" id="id" value="{{ $product->id }}">
											<button type="submit" class="btn btn-sm btn-danger">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr scope="row" class="text-center">
									<td colspan="5"><span class="text-danger"> No products</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{{ $data['products']->links() }}
						</ul>
					</div>
				</div>
				<!-- /.card -->

			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
