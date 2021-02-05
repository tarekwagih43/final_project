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
						<h6 class="float-right"><a href="{{ route('customers.add') }}" class="btn btn-primary"> Add Customer</a></h6>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 20%">image</th>
									<th style="width: 20%">Name</th>
									<th style="width: 20%">Email</th>
									<th style="width: 20%" class="sr-only">Action</th>
								</tr>
							</thead>
							<tbody>
								@if ($data['customers']->count())
								@foreach ($data['customers'] as $customer)
								<tr scope="row">
    								<td><img src="{{ asset($customer->image) }}" class="img-thumbnail h-50" alt="{{ $customer->name }}"></td>
									<td>{{ $customer->name }}</td>
									<td>{{ $customer->email }}</td>
									<td><a href="{{ route('customers.edit', $customer->id) }}" class="d-inline"><span class="btn btn-sm btn-success mr-3">Edit</span></a>
										<form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
											@csrf
											@method('delete')
											<input type="hidden" name="id" id="id" value="{{ $customer->id }}">
											<button type="submit" class="btn btn-sm btn-danger">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr scope="row" class="text-center">
									<td colspan="4"><span class="text-danger"> No customers</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{{ $data['customers']->links() }}
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
