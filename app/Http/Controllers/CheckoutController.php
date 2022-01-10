<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\FeeShip;
use App\Models\customers;
use App\Models\shipping;
use App\Models\orders;
use App\Models\OrderDetails;
use App\Models\statistic;
use Mail;
use Carbon\Carbon;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.Checkout.login_checkout')->with('category',$cate_prod)->with('brand', $brand_prod);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['cus_name'] = $request->cus_name;
        $data['cus_email'] = $request->cus_email;
        $data['cus_password'] = md5($request->cus_password);
        $data['cus_phone'] = $request->cus_phone;
        $customer_id = DB::table('customers')->insertGetId($data);
        Session::put('cus_id', $customer_id);
        Session::put('cus_name', $request->cus_name);
        return Redirect::to('/home');
    }
    public function sign_up(){
        
        return view('pages.Checkout.signin');
    }
    public function checkout(){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $city = City::orderby('matp', 'ASC')->get();
        return view('pages.Checkout.checkout')->with('category',$cate_prod)->with('brand', $brand_prod)->with('city', $city);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['ship_name'] = $request->ship_name;
        $data['ship_email'] = $request->ship_email;
        $data['ship_address'] = $request->ship_address;
        $data['ship_phone'] = $request->ship_phone;
        $data['ship_note'] = $request->ship_note;
        $shipping_id = DB::table('shipping')->insertGetId($data);
        Session::put('ship_id', $shipping_id);
        return Redirect::to('/Payment');
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function user_login(Request $request){
        $email = $request->email_account;
        $password = md5($request->pass_account);

        $result = DB::table('customers')->where('cus_email', $email)->where('cus_password', $password)->first();
        
        if($result){
            Session::put('cus_id', $result->cus_id);
            return Redirect::to('/Checkout');
        }else{
            return Redirect::to('/login-checkout');
        }
    }
    public function payment(){
        $cate_prod = DB::table('category_product')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.Checkout.payment')->with('category',$cate_prod)->with('brand', $brand_prod);
    }
    public function order_place(Request $request){
        //insert payment
        $p_data = array();
        $p_data['pay_method'] = $request->payment_option;
        $p_data['pay_status'] = $request->payment_option;
        $pay_id = DB::table('payment')->insertGetId($p_data);

        //insert order
        $o_data = array();
        $o_data['cus_id'] = Session::get('cus_id');
        $o_data['ship_id'] = Session::get('ship_id');
        $o_data['pay_id'] = $pay_id;
        $o_data['order_total'] = Cart::total();
        $o_data['order_status'] = $request->order_status;
        $ord_id = DB::table('orders')->insertGetId($o_data);

        //insert order detail
        $content = Cart::content();
        foreach($content as $v_content){
            $d_data = array();
            $d_data['order_id'] = $ord_id;
            $d_data['prod_id'] = $v_content->id;
            $d_data['prod_name'] = $v_content->name;
            $d_data['prod_price'] = $v_content->price;
            $d_data['prod_sale_quantity'] = $v_content->qty;
            $d_data = DB::table('order_details')->insert($d_data);
        }
        
        if($p_data['pay_method'] == 1){
            return view('pages.Checkout.handcash');

        }
            Cart::destroy();
            $cate_prod = DB::table('category_product')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
            $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
            return view('pages.Checkout.handcash')->with('category',$cate_prod)->with('brand', $brand_prod);
    }
    public function manage_ordered(){
        $list_order = DB::table('orders')->join('customers','orders.cus_id', '=', 'customers.cus_id')
        ->select('orders.*','customers.cus_name')
        ->get();
        $manager = view('admin.order_manage')->with('list_order', $list_order);
        return view('admin_layout')->with('admin.order_manage',$manager);
    }
    public function view_order($order_id){
        $order_by_id = DB::table('orders')
        ->join('customers','orders.cus_id', '=', 'customers.cus_id')
        ->join('shipping','orders.ship_id', '=', 'shipping.ship_id')
        ->join('order_details','orders.order_code', '=', 'order_details.order_code')
        ->select('orders.*','customers.*','shipping.*','order_details.*')
        ->first();
        $manager = view('admin.order_view')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.order_view',$manager);
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == "city"){
                $select_province = Province::where('matp', $data['matp'])->orderby('maqh', 'ASC')->get();
                $output.='<option value="">--Choose Province--</option>';
                foreach($select_province as $key => $province){
                $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh', $data['matp'])->orderby('xaid', 'ASC')->get();
                $output.='<option value="">--Choose Wards--</option>';
                foreach($select_wards as $key => $wards){
                $output.='<option value="'.$wards->xaid.'">'.$wards->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }
    public function charge_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = FeeShip::where('city_id', $data['matp'])->where('province_id', $data['maqh'])->where('wards_id', $data['xaid'])->get();
            if($feeship){
                $count_fee = $feeship->count();
                if($count_fee){
                    foreach($feeship as $key => $fee){
                Session::put('fee', $fee->fee_feeship);
                Session::save();
                    }
                }else{
                    Session::put('fee', 30000);
                Session::save();
                }
            }
            
        }

    }
    public function confirm(Request $request){
        $data = $request->all();
        $shipping = new shipping();
        $shipping->ship_name = $data['ship_name'];
        $shipping->ship_email = $data['ship_email'];
        $shipping->ship_address = $data['ship_address'];
        $shipping->ship_phone = $data['ship_phone'];
        $shipping->ship_note = $data['ship_note'];
        $shipping->ship_method = $data['ship_method'];
        
        $shipping->save();
        $ship_id = $shipping->ship_id;

        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){

            }
        }
        
        $order_code = substr(md5(microtime()), rand(0,26),10);
        $order = new orders();
        $order['cus_id'] = Session::get('cus_id');
        $order['ship_id'] = $ship_id;
        $order['order_code'] = $order_code;
        $order['order_status'] = 0;
        $order['order_total'] = $data['order_total'];
        $order['order_day'] = now();
        $order->save();

            foreach(Session::get('cart') as $key => $cart){
                $detail = new OrderDetails;
                $detail->order_code = $order_code;
                $detail->prod_id = $cart['prod_id'];
                $detail->prod_name = $cart['prod_name']; 
                $detail->prod_price= $cart['prod_price'];
                $detail->prod_sale_quantity= $cart['prod_quantity'];
                $detail->pord_coupon = $data['order_coupon'];
                $detail->fee_ship = $data['order_fee'];
                $detail->save();
            }

        $now = $order['order_day'];
        $newDate = date("d-m-Y", strtotime($now));
        $date = statistic::orderby('order_date')->get();
        $val = 0;
        
        if($date){
            foreach($date as $key => $date){

                $d = $date->order_date;
                $new = date("d-m-Y", strtotime($d));
                if($newDate == $new){
                    $val = 1; }
                
            }

            if($val == 0) {
                $statistic = new statistic();
                $statistic->order_date = $order['order_day'];
                $statistic->sales = $order['order_total'];
                $statistic->profit = (5*$order['order_total'])/100;
                $quantity = 0;
                $profit = 0;
                foreach(Session::get('cart') as $key => $cart){
                    $quantity = $quantity + $cart['prod_quantity'];
                }
                $statistic->quantity = $quantity;
                $statistic->order_total = 1;
                $statistic->save();
            }else if($val == 1){
                    $id = $date->statistic_id;
                    $statistic = array();
                    $statistic['sales'] = $date->sales + $order['order_total'];
                    $statistic['profit'] = $date->profit + (5*$order['order_total'])/100;
                    $quantity = 0;
                    $profit = 0;
                    foreach(Session::get('cart') as $key => $cart){
                        $quantity = $quantity + $cart['prod_quantity'];
                    }
                    $statistic['quantity'] = $date->quantity + $quantity;
                    $statistic['order_total'] = $date->order_total + 1;
                    DB::table('statistic')->where('statistic_id', $id)->update($statistic);
            } 
        }
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title_mail = "Order date".' '.$now;
      
        $customer = customers::find(Session::get('cus_id'));
            
        $data['email'][] = $customer->cus_email;

        if(Session::get('cart')==true){
      
          foreach(Session::get('cart') as $key => $cart_mail){
      
            $cart_array[] = array(
              'product_name' => $cart_mail['prod_name'],
              'product_price' => $cart_mail['prod_price'],
              'product_qty' => $cart_mail['prod_quantity']
            );
      
          }
      
        }
        if(Session::get('fee')==true){
          $fee = Session::get('fee');
        }else{
          $fee = '30000';
        }
        
        $shipping_array = array(
          'fee' =>  $fee,
          'customer_name' => $customer->cus_name,
          'shipping_name' => $data['ship_name'],
          'shipping_email' => $data['ship_email'],
          'shipping_phone' => $data['ship_phone'],
          'shipping_address' => $data['ship_address'],
          'shipping_notes' => $data['ship_note'],
          'shipping_method' => $data['ship_method']
      
        );
        $ordercode_mail = array(
          'coupon_code' => $data['order_coupon'],
          'order_code' => $order_code,
          'order_total' => $data['order_total'],
        );
      
        Mail::send('pages.mail',  ['cart_array'=>$cart_array, 'shipping_array'=>$shipping_array ,'code'=>$ordercode_mail] , function($message) use ($title_mail,$data){
            $message->to($data['email'])->subject($title_mail);
            $message->from($data['email'],$title_mail);
        });
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
        return view('pages.Checkout.handcash');
    }
}
