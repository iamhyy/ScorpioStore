@extends('layout')
@section('cart')
<div class="container shopping-cart">
  <div class="row">
    <div class="col-md-12"><br><br><hr></div>
    <div class="col-md-12">
    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {!! session()->get('message') !!}
                    </div>
                @elseif(session()->has('error'))
                     <div class="alert alert-danger">
                        {!! session()->get('error') !!}
                    </div>
                @endif
      <h2 class="title" align="center">
            <strong>Shopping</strong>
            Cart
        </h2>
      <div class="clearfix">
      </div>
      <table class="shop-table cart-tbl">
        <thead>
          <tr>
            <th>Image</th>
            <th class="th-detail ">Details</th>
            <th>Price</th>
            <th style="width: 150px;">Quantity</th>
            <th>Total</th>
            <th>Delete</th>
          </tr>
        </thead>
        <?php
        $total_product = 0;
      ?>
      @if(Session::get('cart'))
				@foreach(Session::get('cart') as $key =>  $v_content)
          <tbody>
            <tr>
              <td>
  					    <img src="{{URL::to ('/public/upload/product/'.$v_content['prod_image'] )}}" width="50" alt="">
              </td>
              <td>
                <div class="shop-details">
                  <div class="productname"></div>
                  <h5>
                    <strong class="pcode">{{ $v_content['prod_name'] }}</strong>
                  </h5>
                </div>
              </td>
              <td>
                <h5>{{ number_format($v_content['prod_price'] )}}</h5>
              </td>
              <td class="qty "><h5>
                <div class="form-row">
                  <input class="qty" name="quantity" type="hidden" min="1" max="300" value="{{ $v_content['prod_quantity'] }}">
                  <button class="btn-cart" style="margin-left: 5px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                  {{ $v_content['prod_quantity'] }}
                  <button class="btn-cart" style="margin-right: 5px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
  						  </h5>
              </td>
              <td>
                <h5>
                  <strong class="red">
  						      <?php
                      
  									  $subtotal = $v_content['prod_price']*$v_content['prod_quantity'];
  									  echo number_format($subtotal);
                      $total_product += $subtotal;
  								  ?>
                  </strong>
                </h5>
              </td>
              <td>
                <a href="{{URL::to('/delete-item/'.$v_content['session_id'])}}">
                  <img src="{{URL::to('/public/frontend/images/remove.png')}}" alt="">
                </a>
                </td>
              </tr>
          </tbody>
				@endforeach
        @endif
        <tfoot>
          <tr>
            <td colspan="6"><a href="{{ URL::to('/home') }}">
              <button class="pull-left">
                Continue Shopping
              </button>
              <button class=" pull-right">
                Update Shopping Cart
              </button>
            </td>
          </tr>
        </tfoot>
      </table>
      <div class="clearfix">
      </div>
      <div class="row">
        <div class="col-md-12"> <hr></div>         
        <div class="col-md-12">
          <div class="shippingbox tatal">
				    <ul>
							<li><h4 style="color: red;">Total<span>{{number_format($total_product)}}</span></h4></li>
						</ul>
						
          </div>
        </div>

        <div class="col-md-12">
          <?php 
              $cus_id = Session::get('cus_id');
              if($cus_id != NULL){
            ?>
                <a class=" check_out" href="{{ URL::to('/Checkout') }}">
                <button class="pull-center">Check Out</button></a>
            <?php
              }else{ 
            ?>       
              <a class=" check_out" href="{{ URL::to('/login-checkout') }}">           
              <button class="pull-center">Check Out</button></a>
            <?php
              } 
            ?>
        </div>
      </div>
    </div>
</div>
</div>

<?php
  $message = Session::get('message');
  if($message){
    echo $message;
    Session::put('message', null);
  }
?>

@endsection
