@extends('layout.app')

@section('content')

	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Transactions</h2>
		
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
							<th>Quantity Sold</th>
							<th>Total Amount</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($transactions as $transaction)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $transaction->product_name }}</td>
							<td>{{ $transaction->quantity_sold }}</td>
							<td>{{ $transaction->total_amount }}</td>
							<td>{{ $transaction->created_at }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</section>

	</section>

@endsection