@extends('layout')
@section('content')
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<div class="shippingbox"><!--login form-->
					<h2><strong class="red">
						Login
					</strong> to your account</h2>
					<hr>
					<form action="{{ URL::to('user-login') }}" method="post">{{ csrf_field() }}
						<input type="email" name = "email_account" placeholder="Email Address" />
						<input type="password" name = "pass_account" placeholder="Password " />
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn button">Login</button>
					</form>
				</div><!--/login form-->
				<p align="center" style="font-size: 17px; ">Do not have an account?<a  href="{{ URL::to('/sign-up') }}"><i style="color: red;">Sign up<i></a></p>
			</div>
			
		</div>
	</div>
</section><!--/form-->

@endsection