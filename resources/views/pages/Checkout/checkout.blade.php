@extends('layout')
@section('content')
<div class="col-md-12"><br><br><hr></div>
<section id="cart_items">

	<div class="container">

		<!--<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{ URL::to('/home') }}">Home</a></li>
				<li class="active">Check out</li>
			</ol>
		</div>/breadcrums-->
		<div style="width: 800px;" class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
		</div><!--/register-req-->
		<?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::put('message', null);
    }
    ?>
		<form>@csrf
		<div class="step-description">
			<div class="row">

				<div class="col-md-6 col-sm-6">
					<div class="your-details">
						<h3>
							<strong class="red">Shopper </strong>
							Information 
						</h3>
								
						
							<div class="form-row">
								<label class="lebel-abs">Name
									<strong class="red">*</strong>
								</label>
								<input type="text" name=" ship_name" class="input namefild ship_name" >
							</div>
							<div class="form-row">
								<label class="lebel-abs">Email
									<strong class="red">*</strong>
								</label>
								<input style="width: 300px; margin-right: ;" type="text" name="ship_email" class="input namefild ship_email" >

								<label class="phone">Phone
									<strong class="red">*</strong>
								</label>
								<input style="width: 251px;" type="text" name="ship_phone" class="input namefild ship_phone">
							</div>
							<div class="form-row">
								<label class="lebel-abs">Address
									<strong class="red">*</strong>
								</label>
								<input type="text" name="ship_address" class="input namefild ship_address">
							</div>
							<div class="form-row">
								<form role="form" action="{{URL::to('/charge-fee') }}" method ="post">@csrf
									<table>
										<tr>
											<th><label for="exampleInputPassword1">City</label></th>
											<th><label for="exampleInputPassword1">Province</label></th>
											<th><label for="exampleInputPassword1">Wards</label></th>
										</tr>
										<tr>
											<td>
												<select style="width: 170px; margin-right: 5px;" name="city" id="city" class="input namefild selected choose city">
				                	        <option disabled selected hidden value = "">--Choose City--</option>
				                    	        @foreach($city as $key => $ci)
				                                    <option value = "{{ $ci->matp }}">{{ $ci->name_tp }}</option>
				                                @endforeach
						                        </select>
						                    </td>
						                    <td>
						                    	<select style="width: 170px; margin-right: 5px;" name="province" id="province" class="input namefild selected choose province">
						                            <option disabled selected hidden value = "">--Choose Province--</option>
						                        </select>
						                    </td>
						                    <td>
						                    	<select style="width: 170px;" name="wards" id="wards" class="input namefild selected wards ">
						                            <option disabled selected hidden value = "">--Choose Wards--</option>
						                        </select>
						                    </td>
										</tr>
									</table>
				                </form>
				            </div>
							<div class="form-row">
								
							</div>
							<div class="form-row">
								<textarea name="ship_note" class= "input namefild ship_note" placeholder="Notes about your order, Special Notes for Delivery" rows="5"></textarea>
							</div>
							<div class="form-row">
								@if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{ Session::get('fee' )}}">
								@else
									<input type="hidden" name="order_fee" class="order_fee" value="30000">
								@endif
							</div>
							<div class="form-row">
								@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key => $cou)
										<input type="hidden" name="order_coupon" class="order_coupon" value="{{ $cou['coupon_code'] }}">
									@endforeach
								@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="does not exist">
								@endif
							</div>
							<div class="form-row">
								<label for="exampleInputPassword1"> Payment Option</label>
									<input type="hidden" name="ship_method" class="input namefild selected ship_method" value="1">
									<input style="width: 100%;" type="text" name=""  value="Payment on delivery (COD)">
							</div>
							<div class="form-row">
								<button type="button" value="Submit" name="send_order"  class="pull-left send_order">Submit</button>
							</div>
					</div>
				</div>
				<div class="col-md-1">
					<table style="border-left: 2px outset #b1154a;">
						<tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr><tr><td >|</td></tr>
					</table>
				</div>
				<div class="col-md-5 col-sm-6">

					<?php
				        $total_product = 0;
				      ?>
					<table class="shop-table">
						<tbody>
							@if(Session::get('cart'))
							@foreach(Session::get('cart') as $key =>  $v_content)
								<tr>
									<td class="cart_product">
										<img style="height: 50px;" src="{{URL::to ('/public/upload/product/'.$v_content['prod_image'] )}}" width="50" alt="">
									</td>
									<td class="cart_description">
										<h4 class="productname"><a href="">{{ $v_content['prod_name'] }}</a></h4>
									</td>
									<input type="hidden" class="cart_price" value="{{$v_content['prod_price'] }}">
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<form action="{{URL::to('/UpdateQuantity') }}" method="post">{{ csrf_field() }}
												<input type="hidden" class="cart_quantity_input" type="text" name="cart_quantity" value="{{ $v_content['prod_quantity'] }}" autocomplete="off" size="2">
												<input type="hidden" value="" name="row_id_prod" class="form-control">
												<h4>{{ $v_content['prod_quantity'] }}</h4>
											</form>
										</div>
									</td>
									<td class="cart_total">
										<h4 class="cart_total_price">
											<?php
	  									  		$subtotal = $v_content['prod_price']*$v_content['prod_quantity'];
	  									  		echo number_format($subtotal);
	                      						$total_product += $subtotal;
											?>
										</h4>
									</td>
								</tr>
							@endforeach
							@endif
						</tbody>
					</table>
					<hr>

				</div>
				<div class="col-md-1"></div>
				@if(Session::get('cart'))
					<div class="col-md-5 col-sm-6">
						<div class="form-row">
		                    <form method="post" action="{{URL::to('/CheckCoupon') }}">@csrf
		                      	<input style="width: 270px;" type="text" placeholder="Enter coupon" name="coupon">
		                      	<input style="width: 130px;" name="check_coupon" class="button check_coupon" type="submit" value="Get Coupon">
							  	<!--if(Session::get('coupon'))
							  							  									<button class="button"><a class="check_out" href=" URL::to('/DeleteCoupon') }}">Delete Coupon</a></button>
							  							  								endif-->
		                    </form>
		                </div>
		                <hr>
		            </div>
				@endif	
				<hr>
				<div class="col-md-1"> 
					<div class="ᴠertiᴄal-line" ></div></div>
				<div class="col-md-5 col-sm-6">
						<ul>
							<?php
								$total_product = 0;
								$subtotal = 0;
								if(Session::get('cart')){
									foreach(Session::get('cart') as $key =>  $v_content){
	  								$subtotal = $v_content['prod_price']*$v_content['prod_quantity'];
	                      			$total_product += $subtotal;
								}
								}
								
							?>
							<li><h4>Cart Sub Total: <span>{{ number_format($total_product) }}</span></h4></li>	
							@if(Session::get('coupon'))
								<li>
									
									@foreach(Session::get('coupon') as $key => $cou)
										@if($cou['coupon_feature'] == 0)
											<h4>Discount:<span>{{  $cou['coupon_number']}} %</span></h4>
											<p>
												<?php
													$total_coupon = ($total_product*$cou['coupon_number'])/100;
													echo '<h4><li>Total Amount Reduced<span>'.$total_coupon.'</span></li></h4>';
												?>			
											</p>

										@elseif($cou['coupon_feature'] == 1)
											<h4>Discount:<span>{{  $cou['coupon_number']}} </span></h4>
											<p>
												@php
													$total_coupon = $cou['coupon_number'];				
												@endphp
											</p>
														
										@endif	
									@endforeach
									@php
										$total_cou = $total_coupon;
									@endphp
								</li>
							@endif
							@if(Session::get('fee'))
								<li><h4>Shipping Cost:<span>{{ number_format(Session::get('fee'),0,',',',') }}</span></h4></li>
								<?php 
									$fee = Session::get('fee') ;
									$total = 0;
								?>
							@endif
									
							<li><h4>Eco Tax:<span> {{Cart::tax(0,',',',') }} </span></h4></li>
							<hr>
							<li><h4>Total:<span>		
								@if(Session::get('fee') && !Session::get('coupon'))
									<?php $total = $total_product+$fee;?>
									{{number_format($total,0,',',',')}}
								@elseif(!Session::get('fee') && Session::get('coupon'))
									<?php $total = $total_product-$total_cou;?>
									{{ number_format($total,0,',',',')}}
								@elseif(Session::get('fee') && Session::get('coupon'))
									<?php $total = $total_product+$fee-$total_cou;?>
									{{ number_format($total,0,',',',')  }}
								@elseif(!Session::get('fee') && !Session::get('coupon'))
									<?php $total = $total_product;?>
									{{number_format($total, 0,',',',') }}
								@endif
							</span></h4>
							<input type="hidden" name="" class="order_total" value="{{ $total }}">
							</li>
						</ul>
				</div>
			</div>
		</div>
	</form>
	</div>
</section> <!--/#cart_items-->

@endsection