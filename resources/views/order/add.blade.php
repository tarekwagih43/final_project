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
                    <form id="add_order" action="{{ route('orders.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
						<div class="card-body">
							<div class="form-group">
								<label for="customer_id">Customer</label>
								<select class="form-control" name="customer_id" id="customer_id">
									@if ($data['customers']->count())
									@foreach ($data['customers'] as $customer)
									<option value="{{ $customer->id }}">{{ $customer->name }}</option>
									@endforeach
									@else
									<option class="text-red"> NO Customers</option>
									@endif
								</select>
                            </div>
                            @error('customer_id')
								<div class="text-red mt-2 text-sm">
									{{ $message }}
								</div>
							@enderror
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Open Order</button>
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
