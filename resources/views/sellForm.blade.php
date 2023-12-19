@extends('layout.app')

@section('content')

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Sell Product</h2>
		
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
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-default">
					<thead>
						<tr>
							<th>SL</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Sell Quantity</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
						<tr>
							<td>{{$loop->iteration}}</td>
							<td>{{$product->name}}</td>
							<td>{{$product->price}}</td>
							<td>{{$product->quantity}}</td>
							<td>
								<form class="update-price-form" method="post" action="{{ route('sell', $product->id) }}">
									@csrf
									@method('post')
									<input type="text" name="quantity" class="form-control" style="width: 80px; display: inline-block;" required>

							</td>
							<td>
								<button type="submit" class="btn btn-danger btn-sm">Sell</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</section>

	</section>

@endsection