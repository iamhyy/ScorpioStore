<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--
   <meta name="description" content="">
   <meta name="keywords" content="">
   <meta name="robots" content="INDEX, FOLLOW">
   <meta name="author" content="">
   <meta rel="canonical" href="">
   <link rel="icon" type="image/x-icon" href="">

   //share faceboo
   //<meta property="og:image" content="{$image_og }}"
   <meta property="og:site_name" content="http://localhost/ScorpioStore">
   <meta property="og:description"">
   <meta property="og:title" content="">
   <meta property="og:url" content="">
   <meta property="og:type" content="website">-->





    <title>Home | Scorpio</title>
    <link href="{{asset('/public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/sequence-looptheme.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/flexslider.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('/public/frontend/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('/public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('/public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
     
   </style>
</head><!--/head-->

<body id="home" >
<div class="wrapper">
    <div class="header " style="position: fixed" >
            <div class="container">
               <div class="row">
                  <div class="col-md-2 col-sm-2">
                     <div class="logo" ><a href="{{ URL::to('/') }}"></a><img style="margin-top: 10px;"src="{{URL::to('/public/frontend/images/Scorpio-logos.png')}}" alt="" ></div>
                  </div>
                  <div class="col-md-10 col-sm-10">
                     <div class="header_top">
                        <div class="row">
                           <div class="col-md-3">
                              <ul class="option_nav">
                                 <li class="dorpdown">
                                    <a href="#">Eng</a>
                                    <ul class="subnav">
                                       <li><a href="#">Eng</a></li>
                                       <li><a href="#">Vns</a></li>
                                       <li><a href="#">Fer</a></li>
                                       <li><a href="#">Gem</a></li>
                                    </ul>
                                 </li>
                                 <li class="dorpdown">
                                    <a href="#">USD</a>
                                    <ul class="subnav">
                                       <li><a href="#">USD</a></li>
                                       <li><a href="#">UKD</a></li>
                                       <li><a href="#">FER</a></li>
                                    </ul>
                                 </li>
                              </ul>
                           </div>
                           <div class="col-md-6">
                              <ul class="topmenu">
                                 <li><a href="#">About Us</a></li>
                                 <li><a href="#">News</a></li>
                                 <li><a href="#">Service</a></li>
                                 <li><a href="#">Recruitment</a></li>
                                 <li><a href="#">Media</a></li>
                                 <li><a href="#">Support</a></li>
                              </ul>
                           </div>
                           <div class="col-md-3">
                              <ul class="usermenu">
                              <?php 
                                    $cus_id = Session::get('cus_id');
                                    $ship_id = Session::get('ship_id');
                                    if($cus_id != NULL && $ship_id==NULL){
                                ?>
                                <li><a href="{{ URL::to('/LogoutCheckout') }}"><i class="fa fa-lock"></i> Logout</a></li>
                                <?php
                                }elseif($cus_id != NULL && $ship_id!=NULL){ 
                                ?>
                                
                                <li><a href="{{ URL::to('/Payment') }}"><i class="fa fa-lock"></i> Login</a></li>
                                <?php
                                }else{ 
                                ?>
                                    <li><a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i> Login</a></li>
                                <?php
                                } ?>
                                 <li><a href="{{ URL::to('/sign-up') }}" class="reg"><i class="fa fa-user-circle"></i>Register</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="header_bottom">
                        <ul class="option">
                           <li id="search" class="search">
                              <form method="post" action="{{URL::to('/Search') }}">@csrf
                                 <input class="search-submit" type="submit" value=" "><input class="search-input" placeholder="Enter your search term..." type="text" value="" name="key_sub">
                              </form>
                           </li>
                           @php
				                 $content = Cart::content();
                             $total_product = 0;
				               @endphp
                           <li class="option-cart">
                              <a href="{{ URL::to('show-cart') }}" class="cart-icon">cart <span class="cart_no">02</span></a>
                              <ul class="option-cart-item">
                              @if(Session::get('cart'))
                              @foreach(Session::get('cart') as $key =>  $content)
                                 <li>
                                 
                                    <div class="cart-item">
                                       <div class="image"><img src="{{URL::to ('/public/upload/product/'.$content['prod_image'] )}}" alt=""></div>
                                       <div class="item-description">
                                          <p class="name">{{ $content['prod_name'] }}</p>
                                          <p>Quantity: <span class="light-red">{{ $content['prod_quantity'] }}</span></p>
                                       </div>
                                       <div class="right">
                                          <p class="price">
                                             <?php
									                     $subtotal = $content['prod_price']*$content['prod_quantity'];
                                                echo number_format($subtotal);
                                                $total_product += $subtotal;
								                     ?>
                                          </p>
                                          <a href="#" class="remove"><img src="{{URL::to('public/frontend/images/remove.png')}}" alt="remove"></a>
                                       </div>
                                    </div>
                                 </li>
                              @endforeach  
                              @endif
                                 <li><span class="total">Total <strong>{{ number_format($total_product) }}</strong></span>
                                 <?php 
                                    $cus_id = Session::get('cus_id');
                                    if($cus_id != NULL){
                                ?>
                                <button class="checkout"><a class=" check_out" href="{{ URL::to('/Checkout') }}">Check Out</a></button>
                                <?php
                                }else{ 
                                ?>
                                
                                <button class="checkout"><a class=" check_out" href="{{ URL::to('/login-checkout') }}">Check Out</a></button>
                                <?php
                                } ?>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                        <div class="navbar-header"><button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></div>
                        <div class="navbar-collapse collapse">
                           <ul class="nav navbar-nav">
                              <li>
                                 <a href="{{URL::to('/home')}}" >Home</a>
                                 
                              </li>
                                 <li class="dropdown-toggle" data-toggle="dropdown"><a href="#">hot</a>
                                 <div class="dropdown-menu mega-menu " style="width:300px">
                                    <ul class="mega-menu-links">
                                       <li><a href="#">Eng</a></li>
                                    </ul>
                            </div>
                                 </li>
                              <li><a href="productlitst.html">best seller</a></li>
                              <li class="dropdown  " style="padding-top: 17px;">
                              <form>@csrf
                                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fashion</a>
                                 
                                 <div class="dropdown-menu mega-menu"style="width:500px" >
                                    <div class="row" id="show_menu">
                                       
                                    </div>
                                 </div>
                              </form>
                              </li>

                              <li><a href="productgird.html">blog</a></li>
                              <li><a href="productgird.html">event</a></li>
                              <li><a href="contact.html">contact us</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
             <div class="clearfix"></div>
    <div class="container">
    @yield('slider')
    </div>
    <div class="clearfix"></div>
    <div class="container_fullwidth">
      <div class="col-md-12"><br><br><br><br><br><br></div>
    @yield('sub')
        <div class="container">
            <div class="row">
               @yield('feature_product')
                @yield('cart')
                @yield('hot_item')
                                
                    <div class="col-md-9 ">
                    @yield('content')
                    
                    @yield('detail')           
                    @yield('cate_content')

                </div>
                  @yield('detail_tab')
                </div>
                
            </div>
        </div>
        
    </div>
                            
    <div class="clearfix"></div>
         <div class="footer">
            <div class="footer-info">
               <div class="container">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="footer-logo"><a href="#"><img src="" alt=""></a></div>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Contact <strong>Info</strong></h4>
                        <p>No. 08, Nguyen Trai, Hanoi , Vietnam</p>
                        <p>Call Us : (084) 1900 3748</p>
                        <p>Email : ScorpioStore@gmail.com</p>
                     </div>
                     <div class="col-md-3 col-sm-6">
                        <h4 class="title">Customer<strong> Support</strong></h4>
                        <ul class="support">
                           <li><a href="#">FAQ</a></li>
                           <li><a href="#">Payment Option</a></li>
                           <li><a href="#">Booking Tips</a></li>
                           <li><a href="#">Infomation</a></li>
                        </ul>
                     </div>
                     <div class="col-md-3">
                        <h4 class="title">Get Our <strong>Newsletter </strong></h4>
                        <p>Lorem ipsum dolor ipsum dolor.</p>
                        <form class="newsletter">
							<input type="text" name="" placeholder="Type your email....">
							<input type="submit" value="SignUp" class="button">
						</form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="copyright-info">
               <div class="container">
                  <div class="row">
                     <div class="col-md-6">
                        <p> Scorpio ® 2019. All rights reseved</p>
                     </div>
                     <div class="col-md-6">
                        <ul class="social-icon">
                           <li><a href="#" class="linkedin"></a></li>
                           <li><a href="#" class="google-plus"></a></li>
                           <li><a href="#" class="twitter"></a></li>
                           <li><a href="#" class="facebook"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
    <script src="{{asset('/public/frontend/jspl/bootstrap.min.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery.carouFredSel-6.2.1-packed.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery.elevatezoom.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery.flexslider.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery.sequence-min.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('/public/frontend/jspl/script.min.js')}}"></script>

  
    <script src="{{asset('/public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('/public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('/public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('/public/frontend/js/main.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{asset('/public/frontend/js/sweetalert.js')}}"></script>
    <script typ e="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
               var id=$('.id').val();
               var cart_product_id = $('.cart_product_id_' + id).val();
               var cart_product_name = $('.cart_product_name_' + id).val();
               var cart_product_image = $('.cart_product_image_' + id).val();
               var cart_product_price = $('.cart_product_price_' + id).val();
               var cart_product_qty = $('.cart_product_qty_' + id).val();
               var _token = $('input[name="_token"]').val();
               $.ajax({
                  url: '{{ url('add-cart') }}',
                  method: 'POST',
                  data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                  success:function(){
                     swal({
                        title: "The product has been added to cart",
                        text: "Do you want to go to the shopping cart page?",
                           showCancelButton: true,
                           cancelButtonText: "Continue",
                           confirmButtonClass: "btn-danger",
                           confirmButtonText: "Go To Cart",
                           closeOnConfirm: false
                    },
                    function(){
                        window.location.href = "{{url('show-cart') }}"
                    });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var matp = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'city'){
                result = 'province';

            }else{
                result = 'wards';
            }
            $.ajax({
                url: '{{url('/SelectDelivery') }}',
                method: 'POST',
                data: {action:action, matp:matp, _token:_token},
                success:function(data){
                    $('#'+result).html(data);
                    
                }
            });
        });
    });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.wards').on('change',function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if(matp == '' && maqh=='' && xaid ==''){
                    alert('Please choose city, province and wards');
                }else{
                $.ajax({
                url: '{{url('/charge-fee') }}',
                method: 'POST',
                data: {matp:matp,maqh:maqh,xaid:xaid, _token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }

            });
            }
            });
        });
    </script>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "102916208914037");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Are you sure you want to order?",
                  text: "This task will not be refunded!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes, buy it.",
                  cancelButtonText: "No, cancel plx!",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm) {
                  if (isConfirm) {
                     var ship_name = $('.ship_name').val();
                     var ship_email = $('.ship_email').val();
                     var ship_address = $('.ship_address' ).val();
                     var ship_phone = $('.ship_phone').val();
                     var ship_note = $('.ship_note' ).val();
                     var ship_method = $('.ship_method').val();
                     var order_fee = $('.order_fee').val();
                     var order_coupon = $('.order_coupon' ).val();
                     var order_total = $('.order_total').val();
                     var _token = $('input[name="_token"]').val();
                     var result = '';
                     $.ajax({
                        url: '{{ url('/Confirm') }}',
                        method: 'POST',
                        data:{ship_name:ship_name,ship_email:ship_email,ship_address:ship_address,ship_phone:ship_phone,ship_note:ship_note,ship_method:ship_method,order_fee:order_fee,order_coupon:order_coupon,order_total:order_total,_token:_token},
                        success:function(){
                              swal("Ordered!", "Your order has been sent successfully.", "success");
                              }
                     });
                     
                  } else {
                    swal("Cancelled", "Your order has not been sent, please complete the order :)", "error");
                  }
                
                });
                
            });
        });
    </script>
   <script type="text/javascript">
      $(document).ready(function(){
         load_comment();
         function load_comment(){
            var prod_id = $('.prod_id_cmt').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
               url: '{{url('/LoadComment') }}',
               method: 'POST',
               data: {prod_id:prod_id, _token:_token},
               success:function(data){
                  $('#show_comment').html(data);
               }
            });
         }
         $('.send_comment').click(function(){
            var _token = $('input[name="_token"]').val();
            var prod_id = $('.prod_id_cmt').val();
            var name = $('.comment_name').val();
            var content = $('.comment_content').val();
            $.ajax({
               url: '{{url('/SendComment') }}',
               method: 'POST',
               data: { _token:_token, prod_id:prod_id,name:name, content:content},
               success:function(data){
                  load_comment();
                  swal("Success", "Your comment sended successfully)", "success");
               }
            });

         });
      });
   </script>
      <script type="text/javascript">
      $(document).ready(function(){
         load_comment();
         
         var prod_id = $('.prod_id_cmt').val();
         function load_comment(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
               url: '{{url('/LoadComment') }}',
               method: 'POST',
               data: {prod_id:prod_id, _token:_token},
               success:function(data){
                  $('#show_comment').html(data);
               }
            });
         }
         $('.send_comment').click(function(){
            var _token = $('input[name="_token"]').val();
            var name = $('.comment_name').val();
            var content = $('.comment_content').val();
            $.ajax({
               url: '{{url('/SendComment') }}',
               method: 'POST',
               data: { _token:_token, prod_id:prod_id,name:name, content:content},
               success:function(data){
                  swal("Success", "Your comment sended successfully)", "success");
               }
            });

         });
      });
   </script>
   <script type="text/javascript">
      $(document).ready(function(){
         load_menu();
         function load_menu(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
               url: '{{url('/load-menu') }}',
               method: 'POST',
               data: { _token:_token},
               success:function(data){
                  $('#show_menu').html(data);
               }
            });
         }
         
      });
   </script>
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="0AnSbK3G"></script>
</body>
</html>