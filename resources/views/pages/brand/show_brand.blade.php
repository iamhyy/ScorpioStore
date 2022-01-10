@extends('layout')
@section('cate_content')
<div class="products-grid "><!--features_items-->
    @foreach($brand_name as $key => $cate_n)
        <h2 class="title text-center">{{ $cate_n->brand_name }}</h2>
        <div class="row">
            @foreach($brand_id as $key => $product)
                <div class="col-md-4 col-sm-6">
                    <form action="{{ URL::to('/save-cart') }}" method="post">@csrf
                        <div class="products">
                            <input class="qty" name="quantity" type="hidden" value="1" >
                            <input name="product_id_hidden" type="hidden" value="{{ $product->prod_id }}" />
                            <div class="thumbnail">
                                <a href="{{URL::to('/product-detail/'.$product->prod_id)}}"><img src="{{URL::to ('public/upload/product/'.$product->prod_image )}}" alt="" ></a>
                            </div>
                            <div class="productname">{{$product->prod_name}}</div>
                            <div><h4 class="price new_price">{{ number_format($product->prod_price)}}</h4></div>
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
        @endforeach                        
</div><!--features_items-->
@endsection