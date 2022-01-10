@extends('layout')
@section('detail')
@foreach($prod_detail as $key => $value_de)
<form >{{ csrf_field() }}
<div class="products-details "><!--product-details-->
	<div class="preview_image">
		<div class="preview-small">
			<img height="488px" src="{{ URL::to('/public/upload/product/'.$value_de->prod_image) }}" alt="" />
      <input type="hidden" value="{{$value_de->prod_image}}" class="cart_product_image_{{$value_de->prod_id}}">

      <input type="hidden" class="cart_product_price_{{$value_de->prod_id}}" value="{{$value_de->prod_price}}" >
		</div>						
	</div>
  
	<div class="products-description"><!--/product-information-->
		<h3 class="name productname" style="float: left;">{{ $value_de->prod_name }}</h3>
		
		<hr class="border">
      <p>
		  	
					  <div class="price" style="font-size:  15px"><b>Price : </b>
              @if($value_de->prod_discount == 0)
            	  <strong class="new_price ">{{  number_format($value_de->prod_price,0,',',',') }}</strong>
              @else
            	  <strong class="new_price ">{{  number_format($value_de->prod_price,0,',',',') }}</strong>
                <strike style="font-size: 20px">{{ number_format($value_de->prod_price_old)}}</strike>
              @endif
            </div>
  					<hr class="border">
            <div class="wided">
              <div class="qty">
                <b style="float: left;margin-top: 8px;padding-right: 8px; font-size: 15px;">Quantity:</b>
  							<input style="width: 70px; height: 42px; font-size: 18px;"  class="qty cart_product_qty_{{$value_de->prod_id}}" name="quantity" type="number" min="1" max="300" >
  						</div><br><br>
              <hr class="border">
  						<input name="product_id_hidden" type="hidden"  value="{{ $value_de->prod_id }}" class="cart_product_id_{{$value_de->prod_id}}" />
              <input name="prod_name" type="hidden"  value="{{ $value_de->prod_name }}" class="cart_product_name_{{$value_de->prod_id}}" />
              <input name="product_id_hidden" type="hidden"  value="{{ $value_de->prod_id }}" class="id" />
  						<div class="" style="float: center;">
                <button class="button add-cart add-to-cart  " style="margin-left: 50px; m" type="button" >
                	Add To Cart
                </button>
                <button class="button compare" type="button">
                	<i class="fa fa-exchange"></i>
                </button>
                <button class="button wishlist" type="button">
                	<i class="fa fa-heart-o"></i>
                </button>
                <button class="button favorite">
                  <i class="fa fa-envelope-o"></i>
                </button>
              </div>
              <hr class="border">
  					</div>
		  </p><br><br>
		<hr class="border">
		<h5><b>Availability:</b> In Stock</h5>
		<h5><b>Condition:</b> New</h5>
		<h5><b>Brand:</b> {{ $value_de->brand_name }}</h5>
		<h5><b>Category:</b> {{ $value_de->cate_name }}</h5>
		<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
	</div><!--/product-information-->
</form>
	<div class="clearfix">
  </div>
  <div class="tab-box">
    <div id="tabnav">
      <ul>
        <li>
          <a href="#Descraption">
            DESCRIPTION
          </a>
        </li>
        <li>
          <a href="#Reviews">
            REVIEW
          </a>
        </li>
        <li>
          <a href="#tags">
            PRODUCT TAGS
          </a>
        </li>
      </ul>
    </div>
    <div class="tab-content-wrap">
      <div class="tab-content" id="Descraption">
        <p>
              {{ $value_de->prod_content }}
        </p>
        <p>             
        </p>
      </div>
      <div class="tab-content" id="Reviews">
        <form method="">@csrf
          <table>
            <thead>
              <tr>
                <th>
                  &nbsp;
                </th>
                <th>
                  1 star
                </th>
                <th>
                  2 stars
                </th>
                <th>
                  3 stars
                </th>
                <th>
                  4 stars
                </th>
                <th>
                  5 stars
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  Quality
                </td>
                <td>
                  <input type="radio" name="quality" value="Blue"/>
                </td>
                <td>
                  <input type="radio" name="quality" value="">
                </td>
                <td>
                  <input type="radio" name="quality" value="">
                </td>
                <td>
                  <input type="radio" name="quality" value="">
                </td>
                <td>
                  <input type="radio" name="quality" value="">
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-row">
                <label class="lebel-abs">
                  Your Name 
                  <strong class="red">
                                *
                  </strong>
                </label>
                <input type="text" name="" class="input namefild comment_name">
              </div>
              
              
            </div>
            <div class="col-md-12 col-sm-6">
              <div class="form-row">
                <label class="lebel-abs">
                  Comment 
                  <strong class="red">
                    *
                  </strong>
                </label>
                <textarea class="input textareafild comment_content" name="" rows="6" ></textarea>
              </div>
              <div class="form-row">
                <input type="button" value="Submit" class="button send_comment">
              </div>
              <div id="notification"></div>
            </div>
          </div>
          <div class="" id="show_comment">
            @foreach($comment as $key => $comm)
            <input type="hidden" name="prod_id" class="prod_id_cmt" value="{{ $comm->prod_id }}">
            @endforeach
          </div>
        </form>
      </div>
        
      

      
      <div class="tab-content" id="tags">
        <div class="tag">
          Add Tags : 
          <input type="text" name="">
          <input type="submit" value="Tag">
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>
@endforeach
<div class="products-grid "><!--Recommended items-->
  <h2 class="title">
    <strong>Recommend</strong>
    Products
  </h2>
  <div class="row">
		@foreach($vl_relate as $key => $relate)
		  <div class="col-md-4 col-sm-6">
        <div class="products">
          <div class="thumbnail">
						<a href="{{URL::to('/product-detail/'.$relate->prod_id)}}"><img src="{{URL::to ('public/upload/product/'.$relate->prod_image )}}" alt="" ></a>
          </div>
          <div class="productname">{{$relate->prod_name}}</div>
          <div><h4 class="price">{{ number_format($relate->prod_price)}}</h4></div>
          <div class="button_group">
            <button class="button add-cart" type="button">Add To Cart</button>
            <button class="button compare" type="button"><i class="fa fa-exchange"></i></button>
            <button class="button wishlist" type="button"><i class="fa fa-heart-o"></i></button>
          </div>
				</div>
			</div>
		@endforeach
	</div>
</div><!--/recommended_items-->
@endsection
@section('detail_tab')
<div class="col-md-3">
              <div class="special-deal leftbar">
                <h4 class="title">
                  Special 
                  <strong>
                    Deals
                  </strong>
                </h4>
                @foreach($special as $key => $spe)
                <div class="special-item">
                  <div class="product-image">
                    <a href="{{URL::to('/product-detail/'.$spe->prod_id)}}">
                      <img height="50px" src="{{URL::to ('public/upload/product/'.$spe->prod_image )}}" alt="">
                    </a>
                  </div>
                  <div class="product-info">
                    <p>
                      {{ $spe->prod_name }}
                    </p>
                    @if($spe->prod_discount == 0)
                      <strong class="new_price price ">{{  number_format($spe->prod_price,0,',',',') }}</strong>
                    @else
                    <strong class="new_price price ">{{  number_format($spe->prod_price,0,',',',') }}</strong>
                      <strike style="font-size: 10px">{{ number_format($spe->prod_price_old)}}</strike>
                    @endif
                  </div>
                </div>
                @endforeach
              </div>
              <div class="clearfix">
              </div>
              <div class="product-tag leftbar">
                <h3 class="title">
                  Products 
                  <strong>
                    Tags
                  </strong>
                </h3>
                <ul>
                @foreach($cate_n as $key => $category)
                  <li>
                    <a href="#">
                      {{ $category->cate_name }}
                    </a>
                  </li>
                 @endforeach
                </ul>
              </div>
              <div class="clearfix">
              </div>
              <div class="get-newsletter leftbar">
                <h3 class="title">
                  Get 
                  <strong>
                    newsletter
                  </strong>
                </h3>
                <p>
                  Casio G Shock Digital Dial Black.
                </p>
                <form>
                  <input class="email" type="text" name="" placeholder="Your Email...">
                  <input class="submit" type="submit" value="Submit">
                </form>
              </div>
              <div class="clearfix">
              </div>
              <div class="fbl-box leftbar">
                <h3 class="title">
                  Facebook
                </h3>
                <span class="likebutton">
                  <a href="#">
                    <img src="images/fblike.png" alt="">
                  </a>
                </span>
                <p>
                  12k people like Flat Shop.
                </p>
                <ul>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                  <li>
                    <a href="#">
                    </a>
                  </li>
                </ul>
                <div class="fbplug">
                  <a href="#">
                    <span>
                      <img src="images/fbicon.png" alt="">
                    </span>
                    Facebook social plugin
                  </a>
                </div>
              </div>
@endsection
