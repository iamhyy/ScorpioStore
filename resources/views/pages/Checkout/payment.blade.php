@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/home') }}">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to ('/public/upload/product/'.$v_content->options->image )}}" width="50" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $v_content->name }}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{ number_format($v_content->price )}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/UpdateQuantity') }}" method="post">
										{{ csrf_field() }}
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $v_content->qty }}" autocomplete="off" size="2">
									<input type="hidden" value="{{  $v_content->rowId}}" name="row_id_prod" class="form-control">
									<input type="submit" value="update" name="up_qty" class="btn btn-default btn-sm">
									<a class="cart_quantity_down" href=""> - </a>
								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
									$subtotal = $v_content->price*$v_content->qty;
									echo number_format($subtotal);
								?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/DeleteCart/'.$v_content->rowId) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
			<form method="post" action="{{ URL::to('/OrderPlace') }}">{{ csrf_field() }}
			<div class="payment-options">
					<span>
						<label><input type="checkbox" name="payment_option" value="1"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox" name="payment_option" value="2"> Check Payment</label>
					</span>
					{{-- <span>
						<label><input type="checkbox"> Paypal</label>--}}
					<input type="submit" value = "Order" name="order" class="btn btn-primary btn-sm">														
				</div>
				</form>
		</div>
	</section> <!--/#cart_items-->

@endsection