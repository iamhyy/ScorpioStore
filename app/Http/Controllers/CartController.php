<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Coupon;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        $product_info = DB::table('products')->where('prod_id', $product_id)->first();
        $data['id'] = $product_info->prod_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->prod_name;
        $data['price'] = $product_info->prod_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->prod_image;
        Cart::add($data);
        Cart::setGlobalTax(0);
        return Redirect::to('/product-detail/'.$product_id);


    }
    public function show_cart(){

        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_prod)->with('brand', $brand_prod);
    }

    public function delete_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/ShowCart');

    }

    public function update_quantity(Request $request){
        $rowId = $request->row_id_prod;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/ShowCart');
    }

    public function add_cart(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart){
            $is_valiable = 0;
            foreach($cart as $key => $val){
                if($val['prod_id']==$data['cart_product_id']){
                    $is_valiable++;
                }
            }
            if($is_valiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'prod_name' => $data['cart_product_name'],
                'prod_id' => $data['cart_product_id'],
                'prod_image' => $data['cart_product_image'],
                'prod_quantity' => $data['cart_product_qty'],
                'prod_price' => $data['cart_product_price']
            );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'prod_name' => $data['cart_product_name'],
                'prod_id' => $data['cart_product_id'],
                'prod_image' => $data['cart_product_image'],
                'prod_quantity' => $data['cart_product_qty'],
                'prod_price' => $data['cart_product_price']
            );
            Session::put('cart', $cart);
        }
        
        Session::save();

    }
    public function delete_item($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Delete product successfully');
    
        }else{
            return redirect()->back()->with('message','Delete product failed');
        }
    
    }
    public function cart(Request $request){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_prod)->with('brand', $brand_prod);
    }
    //coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if($coupon){
            $count = $coupon->count();
            if($count > 0){
                $session = Session::get('coupon');
                if($session == true){
                    $is_valiable = 0;
                    if($is_valiable == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_feature' => $coupon->coupon_feature,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_feature' => $coupon->coupon_feature,
                            'coupon_number' => $coupon->coupon_number,
                        );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', '
The coupon has been added successfully.');
            }
        }else{
            return redirect()->back()->with('message', '
The coupon is incorrect.');
        }
    }

    public function delete_couponn(){
        $coupon = Session::get('coupon');
        if($coupon){
            Session::forget('coupon');
            return redirect()->back()->with('message', 'The coupon has been deleted successfully.');
        }
    }

    //coupon admin
    public function add_coupon(){
        return view('admin.coupon.add_coupon');
    }
    public function save_coupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_qty = $data['coupon_qty'];
        $coupon->coupon_feature = $data['coupon_feature'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();
        Session::put('message', '
The coupon has been added successfully.');
        return Redirect::to('/admin/AddCoupon');
    }
    public function list_coupon(){
        $coupon = Coupon::orderby('coupon_id', 'DESC')->get();
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function delete_coupon($coupon_id){
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message', '
The coupon has been deleted successfully.');
        return Redirect::to('/admin/ListCoupon');
    }
    
}
