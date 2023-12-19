@extends('layout.app')

@section('content')

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Add Products</h2>
		
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li>
						<a href="{{url('/')}}">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Dashboard</span></li>
				</ol>
			</div>
		</header>

		<section class="panel">
			<div class="row panel-body">
				<form method="post" action="{{ route('store') }}" class="col-md-6">
					@csrf
					
					<div class="form-group">
						<label for="name" class="form-label">Product Name:</label>
					  	<input type="text" class="form-control" id="name" name="name" required placeholder="product name">
					</div>

					<div class="form-group">
						<label for="price" class="form-label">Price:</label>
					  	<input type="number" class="form-control" id="price" name="price" placeholder="price">
					</div>

					<div class="form-group">
						<label for="quantity" class="form-label">Quantity:</label>
						<input type="number" class="form-control" id="quantity" name="quantity" min="0" placeholder="quantity" required>
					</div>

					<div class="form-group"></div>
					<button type="submit" class="btn btn-primary mt-3">Add Product</button>

				</form>
			</div>
		</section>

	</section>

@endsection