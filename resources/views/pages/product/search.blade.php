@extends('layout')
@section('content')

<div class="products-grid"><!--search_items-->
    <br>
    <br>
    <br>
    <br>
    <hr>

    <div class="row">
        @foreach($search as $key => $product)
            <div class="col-md-4 col-sm-6">
                <form action="{{ URL::to('/save-cart') }}" method="post">@csrf
                    <div class="products">
                        @if($product->prod_discount > 0)
                            <div class="offer">- {{$product->prod_discount}} %</div>
                        @endif
                        <input class="qty" name="quantity" type="hidden" value="1" >
                        <input name="product_id_hidden" type="hidden" value="{{ $product->prod_id }}" />
                        <div class="thumbnail">
                            <a href="{{URL::to('/product-detail/'.$product->prod_id)}}">
                            <img src="{{URL::to ('/public/upload/product/'.$product->prod_image )}}" alt="" />

                        </div>
                        <div class="productname">{{$product->prod_name}}</div>
                        @if($product->prod_discount == 0)
                            <div><h4 class="price new_price">{{ number_format($product->prod_price)}}</h4></div>
                        @else
                            <div><h4 class="price new_price form-row" style="width: 150px; padding-left:50px">{{ number_format($product->prod_price)}}</h4>
                                <strike style="font-size: 16px">{{ number_format($product->prod_price_old)}}<strike>
                            </div>
                        @endif
                        <div class="button_group">
                            <button class="button add-cart" type="submit">Add To Cart</button>
                            <button class="button compare" type="button"><i class="fa fa-exchange"></i></button>
                            <button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button>
                        </div> 
                    </div>
                </form>
            </div>
        @endforeach  
    </div>   
</div><!--search_items-->
  @endsection
@section('sub')

<div class="col-sm-2" style="margin-left: 120px;">
    <hr style="background-color: #ff6666 ;">
                <h3>Search</h3>
                <hr>
        <div class="form-row">
            <b style="font-size: 15px;">Shipping Type</b>
            <button style="float: right ; border: none; padding-top: 5px; "><i class="fa fa-minus" aria-hidden="true"></i></button>

        </div>
        <div class="form-row">
            <input type="checkbox" name="">Today
        </div>
        <div class="form-row">
            <input type="checkbox" name="">Store Pick
        </div>
        <div class="form-row">
            <input type="checkbox" name="">Today's Direct
        </div>  
    <hr>
    <div class="form-row">
        <b style="font-size: 15px;">Benefits</b>
        <button style="float: right ; border: none; padding-top: 5px; "><i class="fa fa-minus" aria-hidden="true"></i></button>

    </div>
    <div class="form-row">
        <input type="checkbox" name="">FREE shipping
    </div>
    <hr>
    <div class="form-row">
        <b style="font-size: 15px;">Brand</b>
        <button style="float: right ; border: none; padding-top: 5px; "><i class="fa fa-minus" aria-hidden="true"></i></button>
    </div>
    <div class="form-row">
        <input  type="text" name="" class="brand_input">
        <button style="float: right;"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
    <hr>
    <div class="form-row">
        <b style="font-size: 15px;">Color</b>
        <button style="float: right ; border: none; padding-top: 5px; "><i class="fa fa-minus" aria-hidden="true"></i></button>
    </div>
        <button style="border-radius: 50%; background-color: #ff6666; height: 45px; margin-right: 20px; margin-bottom: 20px; margin-left: 30px;" ></button>
        <button style=" border-radius: 50%; background-color: #99ccff;height: 45px;margin-right: 20px;margin-bottom: 20px;"></button>
        <button style="border-radius: 50%; background-color: #ffff66; height: 45px; margin-right: 20px;margin-bottom: 20px;" ></button>
        

        <button style="border-radius: 50%; background-color: #66ff99; height: 45px; margin-right: 20px;margin-bottom: 20px; margin-left: 30px;" ></button>
        <button style=" border-radius: 50%; background-color: #ffccff;height: 45px;margin-right: 20px;margin-bottom: 20px;"></button>
        <button style=" border-radius: 50%; background-color: #cc66ff;height: 45px;margin-right: 20px;margin-bottom: 20px;"></button>

        

        <button style="border-radius: 50%; background-color: #999966; height: 45px; margin-right: 20px; margin-left: 30px;" ></button>
        <button style=" border-radius: 50%; background-color: white;height: 45px;margin-right: 20px;"></button>
        <button style=" border-radius: 50%; background-color: black;height: 45px;margin-right: 20px;margin-bottom: 20px;"></button>
    <hr>
    <div class="form-row">
        <b style="font-size: 15px;">Price</b>
        <button style="float: right ; border: none; padding-top: 5px; "><i class="fa fa-minus" aria-hidden="true"></i></button>

    </div> 
    <div class="price-filter ">
                    <form class="pricing">
                  <label>
                    $ 
                    <input type="number">
                  </label>
                  <span class="separate">
                    - 
                  </span>
                  <label>
                    $ 
                    <input type="number">
                  </label>
                  <input type="submit" value="Go">
                </form>
              </div>
                                    
</div>
@endsection