<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body style="font-family: Candara;">
	<div class="container" style="border-radius: 12px;padding:15px;">
		<div class="col-md-12" >

			<p style="text-align: center;color: black">This is an automated email. Please do not reply to this email.</h4>
			<div class="row" style="background: rgb(240, 188, 180);padding: 15px ;border-radius: 35px;">

				
				<div class="col-md-6" style="text-align: center;color: white;font-weight: bold;font-size: 30px">
					<h2 style="margin:0 ;color:black"><b>SCORPIO STORE</b></h2>
				</div>

				<div class="col-md-6 logo"  style="color: white">
					<h4>Hello <strong style="color: #000;text-decoration: underline;">{{$shipping_array['customer_name']}}</strong>,</h4>
				</div>
				
				<div class="col-md-12">
					<h4 style="color:#fff;font-size: 17px;">You or someone else placed an order with the following information: </h4>
                    <hr>
					<h3 style="color: #000; text-align: center;">Order information:</h3>
					<h4>Order code : <strong style="text-transform: uppercase;color:#fff">{{$code['order_code']}}</strong></h4>
					<h4>Coupon code : <strong style="text-transform: uppercase;color:#fff">{{$code['coupon_code']}}</strong></h4>
					<h4>Fee ship : <strong style="text-transform: uppercase;color:#fff">{{$shipping_array['fee']}}</strong></h4>
					<hr>
					<h3 style="color: #000;text-align: center;">Receiver's information:</h3>

					<h4>Email :
							<span style="color:#fff">{{$shipping_array['shipping_email']}}</span>
						
					</h4>

					<h4>Name: 
							<span style="color:#fff">{{$shipping_array['shipping_name']}}</span>
					
					</h4>
					<h4>Address : 
							<span style="color:#fff">{{$shipping_array['shipping_address']}}</span>
					</h4>	
					<h4>Phone number: 
							<span style="color:#fff">{{$shipping_array['shipping_phone']}}</span>
						
					</h4>	
					<h4>Note: 
						@if($shipping_array['shipping_notes']=='')
							<span style="color:#fff">don't have note</span>
						@else
							<span style="color:#fff">{{$shipping_array['shipping_notes']}}</span>
						@endif
					</h4>	
					<h4>Payment method: <strong style="color:#fff">
                    Payment on delivery (COD)
					
					</strong></h4>
                    <hr>


					<h3 style="color: #000;text-align: center;">Order detail</h3>
                    <h4>
					<table  style="border:1px solid white; width: 100%;">
						<thead style="border: 1px solid white">
							<tr>
								<th >Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>

							</tr>
						</thead>

						<tbody style="border: 1px solid white; text-align: center;">
							<?php 
							$sub_total = 0;
                            $o_total = 0;
							$total = 0;
							?>

							@foreach($cart_array as $cart)

							<?php
							$sub_total = $cart['product_qty']*$cart['product_price'];
							$total+=$sub_total;
							?>

							<tr>
								<td >{{$cart['product_name']}}</td>
								<td>{{number_format($cart['product_price'],0,',','.')}}</td>
								<td>{{$cart['product_qty']}}</td>
								<td>{{number_format($sub_total,0,',','.')}}</td>
							</tr>
							@endforeach

							
								
								

						</tbody>
					</table></h4>
					<h3 style="text-align:right;">Total: {{number_format($code['order_total'],0,',','.')}}</h3>
							
                    <hr>
				</div>
                
				
				<h4 style="color:#fff;text-align: center;">If the consignee information is not correct, please contact us as soon as possible!</h4>
                    <hr>
				<p style="color:#fff">For more information, please contact the website at: <a target="_blank" href="http://scorpiostore.com/">http://scorpiostore.com/</a>, or contact us via hotline: (084) 1900 3748. Thank you for ordering from our shop.</h4>

			</div>
		</div>
	</div>
</body>
</html>