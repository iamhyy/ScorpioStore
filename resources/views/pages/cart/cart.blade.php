@extends('layout')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/CoGoShop/home') }}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				
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
						<tr>
							<td class="cart_product">
								<a href=""><img src="" width="50" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/CoGoShop/UpdateQuantity') }}" method="post">
										{{ csrf_field() }}
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="" autocomplete="off" size="2">
									<input type="hidden" value="" name="row_id_prod" class="form-control">
									<input type="submit" value="update" name="up_qty" class="btn btn-default btn-sm">
									<a class="cart_quantity_down" href=""> - </a>
								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
									
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>{{Cart::subtotal()}}</span></li>
							<li>Eco Tax <span>{{Cart::tax()}}</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>{{Cart::total()}}</span></li>
						</ul>
						
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection