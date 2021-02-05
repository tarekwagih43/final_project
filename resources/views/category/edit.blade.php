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
						<h3 class="card-title">{{ $data['category']['title'] }} <small>Edit</small></h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id="add_category" action="{{ route('categories.edit', $data['category']) }}" method="POST">
						@csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="{{ $data['category']['id'] }}">
						<div class="card-body">
							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="Category Title" value="{{ $data['category']['title'] }}">
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button type="submit" class="btn btn-primary float-right">Edit Category</button>
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
