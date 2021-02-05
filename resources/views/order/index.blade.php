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
						<h6 class="float-right"><a href="{{ route('orders.add') }}" class="btn btn-primary"> Open Order</a></h6>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 40%">Customer</th>
									<th style="width: 30%" class="sr-only">Action</th>
								</tr>
							</thead>
							<tbody>
								@if ($data['orders']->count())
								@foreach ($data['orders'] as $order)
								<tr scope="row">
									<td>{{ $order->customer_name }}</td>

									<td align="center"><a href="{{ route('orders.view', $order->id) }}" class="d-inline"><span class="btn btn-sm btn-success mr-3">View</span></a>
										<form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
											@csrf
											@method('delete')
											<input type="hidden" name="id" id="id" value="{{ $order->id }}">
											<button type="submit" class="btn btn-sm btn-danger">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr scope="row" class="text-center">
									<td colspan="3"><span class="text-danger"> No orders</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{{ $data['orders']->links() }}
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
