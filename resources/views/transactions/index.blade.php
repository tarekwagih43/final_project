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
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 10%">Order ID</th>
									<th style="width: 20%">User</th>
									<th style="width: 20%">Customer</th>
									<th style="width: 15%">Amount</th>
									<th style="width: 20%">Note</th>
									<th style="width: 20%" class="sr-only">Action</th>
								</tr>
							</thead>
							<tbody>
								@if ($data['transactions']->count())
								@foreach ($data['transactions'] as $transaction)
								<tr scope="row">
									<td><a href="{{ route('orders.view', $transaction->order_id) }}"># {{ $transaction->order_id }} </a></td>
									<td>{{ $transaction->user_name }}</td>
									<td>{{ $transaction->customer_name }}</td>
									<td>{{ $transaction->paied }}</td>
									<td><p>{{ $transaction->notes }}</p></td>
                                    <td>
										<form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" >
											@csrf
											@method('delete')
											<input type="hidden" name="id" id="id" value="{{ $transaction->id }}">
											<button type="submit" class="btn btn-sm btn-danger">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
								@else
								<tr scope="row" class="text-center">
									<td colspan="6"><span class="text-danger"> No Transactions</span></td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<ul class="pagination pagination-sm m-0 float-right">
							{{ $data['transactions']->links() }}
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
