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
						<h3 class="card-title p-1">{{ $data['page_title'] }}</h3>
						<h6 class="float-right"><a href="{{ route('categories.add') }}" class="btn btn-primary"> Add Category</a></h6>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 20%">#</th>
									<th style="width: 50%">Title</th>
									<th style="width: 30%" class="sr-only">Action</th>
								</tr>
							</thead>
							<tbody>
								@if ($data['categories']->count())
								@foreach ($data['categories'] as $category)
								<tr scope="row">
									<td>{{ $category->id }}</td>
									<td>{{ $category->title }}</td>
									<td><a href="{{ route('categories.edit', $category) }}" class="d-inline"><span class="btn btn-sm btn-success mr-3">Edit</span></a>
										<form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
											@csrf
											@method('delete')
											<input type="hidden" name="id" id="id" value="{{ $category->id }}">
											<button type="submit" class="btn btn-sm btn-danger">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr scope="row" class="text-center">
									<td colspan="3"><span class="text-danger"> No Categories</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{{ $data['categories']->links() }}

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
