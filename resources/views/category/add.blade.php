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
						<h3 class="card-title">Add Category</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form id="add_category" action="{{ route('categories.add') }}" method="POST">
						@csrf
						@method('POST')
						<div class="card-body">
							<div class="form-group">
								<label for="title">Category Title</label>
								<input type="text" name="title" class="form-control" id="title" placeholder="Category Title">
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button type="submit" class="btn btn-primary float-right">Add Category</button>
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
