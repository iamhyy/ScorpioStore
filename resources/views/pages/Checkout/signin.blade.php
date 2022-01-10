@extends('layout')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row" style="margin-left: 20%;">
			
			<div class="col-sm-5">
				<div class="shippingbox"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="{{ URL::to('/AddCustomer') }}" method = "post"> {{ csrf_field() }}
						<input type="text" name="cus_name" placeholder="Name"/>
						<input type="email" name="cus_email" placeholder="Email Address"/>
						<input type="password" name="cus_password" placeholder="Password"/>
						<input type="text" name="cus_phone" placeholder="Phone Number"/>
						<button type="submit" class="button" style="margin-left: 35%;">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection