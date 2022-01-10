@extends('layout')
@section('slider')
<!--slider-->
 <div class="hom-slider">
    <img width="100%" height="100%" src="{{ URL::to('public/frontend/images/winter_holiday.jpg') }}" alt="">
            
            <div class="promotion-banner">
               <div class="container">
                  <div class="row">
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="promo-box"><img src="{{ URL::to('public/frontend/images/winter_sale.jpg') }}" alt=""></div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="promo-box"><img src="{{ URL::to('public/frontend/images/exclusive.jpg') }}" alt=""></div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="promo-box"><img src="{{ URL::to('public/frontend/images/essential.jpg') }}" alt=""></div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="promo-box"><img src="{{ URL::to('public/frontend/images/welcome_coupon.jpg') }}" alt=""></div>
                     </div>
                  </div>
               </div>
            </div>

    </div>
    <div class="col-md-12">
        <br>
        <hr>
        <br>
    </div>
    <div class="container">
        
        <img width="100%" height="90%" src="{{ URL::to('public/frontend/images/delight.jpg') }}" alt="">
    </div>
    <div class="col-md-12">
        <br>
        <hr>
        <br>
    </div>
    <div class="container">
        <br>
        <hr>
        <br>
        <img width="100%" height="90%" src="{{ URL::to('public/frontend/images/bora_collection.jpg') }}" alt="">
    </div>
    
@section('feature_product')
    <div class="products-grid "><!--features_items-->
        <h2 class="title" align="center">
            <strong>Feature</strong>
            Products
        </h2>
        <div class="row">
            @foreach($prod as $key => $product)
                <div class="col-md-3 col-sm-6">

                    <div class="products">
                        <div class="thumbnail">
                            <img src="{{URL::to ('public/upload/product/'.$product->prod_image )}}" alt="" ></a>
                        </div>
                        <div class="productname">{{$product->prod_name}}</div>
                        <div><h4 class="price">{{ number_format($product->prod_price)}}</h4></div>
                        <div class="button_group">
                            <button class="button add-cart" type="button">Add To Cart</button>
                            <button class="button compare" type="button"><i class="fa fa-exchange"></i></button>
                            <button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button>
                        </div>
                        <form>@csrf
                            <input type="hidden" class="cart_product_id_{{ $product->prod_id}}" value="{{ $product->prod_id}}">
                            <input type="hidden" class="cart_product_name_{{ $product->prod_id}}" value="{{ $product->prod_name}}">
                            <input type="hidden" class="cart_product_image_{{ $product->prod_id}}" value="{{ $product->prod_image}}">
                            <input type="hidden" class="cart_product_price_{{ $product->prod_id}}" value="{{ $product->prod_price}}">
                            <input type="hidden" class="cart_product_qty_{{ $product->prod_id}}" value="{{ $product->prod_quantity}}">
                        </form>
                    </div>
                </div>
            @endforeach 
        </div>
                            
    </div><!--features_items-->
                    
@endsection
@section('hot_item')
    <div class="products-grid "><!--hot_items-->
        <h2 class="title" align="center">
            <strong>Hot</strong>
            Products
        </h2>
        <div class="row">
            @foreach($hot_prod as $key => $product)
                <div class="col-md-3 col-sm-6">
                    <form action="{{ URL::to('/save-cart') }}" method="post">@csrf
                        <div class="products">
                            <input class="qty" name="quantity" type="hidden" value="1" >
                            <input name="product_id_hidden" type="hidden" value="{{ $product->prod_id }}" />
                            <div class="thumbnail">
                                <a href="{{URL::to('/product-detail/'.$product->prod_id)}}">
                                <img src="{{URL::to ('public/upload/product/'.$product->prod_image )}}" alt="" ></a>
                            </div>
                            <div class="productname">{{$product->prod_name}}</div>
                            <div><h4 class="price new_price">{{ number_format($product->prod_price)}}</h4></div>
                            <div class="button_group">
                                <button class="button add-cart" type="submit">Add To Cart</button>
                                <button class="button compare" type="button"><i class="fa fa-exchange"></i></button>
                                <button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button>
                            </div>
                            <form>@csrf
                                <input type="hidden" class="cart_product_id_{{ $product->prod_id}}" value="{{ $product->prod_id}}">
                                <input type="hidden" class="cart_product_name_{{ $product->prod_id}}" value="{{ $product->prod_name}}">
                                <input type="hidden" class="cart_product_image_{{ $product->prod_id}}" value="{{ $product->prod_image}}">
                                <input type="hidden" class="cart_product_price_{{ $product->prod_id}}" value="{{ $product->prod_price}}">
                                <input type="hidden" class="cart_product_qty_{{ $product->prod_id}}" value="{{ $product->prod_quantity}}">
                            </form>
                        </div>
                    </form>
                </div>
            @endforeach 
        </div>
                            
    </div><!--features_items-->
@endsection
@section('sub')
<!--<div class="col-md-3">
    <div class="category leftbar">
        <h3>Category</h3>              
        <ul>
            foreach($category as $key => $cate)               
                <li>
                    <a href="{URL::to('/category-product/'.$cate->cate_id) }}">{ $cate->cate_name }}</a>
                </li>
            endforeach
        </ul>
                            
    </div>
    <div class="clearfix"></div>
    <div class="category leftbar">
        <h3>Brands</h3>
        <ul >
            foreach($brand as $key => $brand)
                <li><a href="{URL::to('/BrandProduct/'.$brand->brand_id) }}"> { $brand->brand_name }}</a></li>
            endforeach 
        </ul>
                                
    </div>
    <div class="shipping text-center">
         <img src="images/home/shipping.jpg" alt="" />
    </div>
                    
</div>-->
@endsection

@section('category_sub')
@foreach($category as $key => $cate)
                            
                                <li>
                                    <a href="{{URL::to('/category-product/'.$cate->cate_id) }}">{{ $cate->cate_name }}</a>
                                </li>
                                @endforeach
@endsection