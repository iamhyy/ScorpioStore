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

use App\Models\shipping;
use App\Models\orders;
use App\Models\OrderDetails;
use App\Models\customers;
use App\Models\Coupon;
use App\Http\Controllers\CartController;

use PDF;

use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
    public function manage_order(){
        $order = orders::orderby('order_day','DESC')->get();
        return view('admin.order_manage')->with(compact('order'));
    }
    public function view_order($order_code){
        $order_details = OrderDetails::where('order_code', $order_code)->get();
        $order = orders::where('order_code', $order_code)->get();
        foreach($order as $key => $ord){
            $cus_id = $ord->cus_id;
            $ship_id = $ord->ship_id;

        }
        $customer = customers::where('cus_id', $cus_id)->first();
        $shipping = shipping::where('ship_id', $ship_id)->first();

        $details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
        foreach($details_product as $key => $order_d){
            
            $prod_coupon = $order_d->pord_coupon;
            
        }
        if($prod_coupon != 'does not exist'){
            $coupon = Coupon::where('coupon_code', $prod_coupon)->first();
            $coupon_feature = $coupon->coupon_feature;
            $coupon_number = $coupon->coupon_number;
        
        }else{
            $coupon_feature = '';
            $coupon_number = 0;
        }
        
        return view('admin.order_view')->with(compact('order_details','order','customer','shipping','details_product','prod_coupon','coupon_feature','coupon_number'));
    }

    public function delete_order($order_id){

        $order = orders::where('order_id', $order_id)->get();

        DB::table('orders')->where('order_id', $order_id)->delete();
        foreach($order as $key => $or){
            $code = $or->order_code;
            $ship = $or->ship_id;
            DB::table('order_details')->where('order_code', $code)->delete();
        }
        
        DB::table('shipping')->where('ship_id', $ship)->delete();
        Session::put('message', 'The order has been deleted successfully.');
        return Redirect::to('/admin/Orders');

    } 

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code', $checkout_code)->get();
        $order = orders::where('order_code', $checkout_code)->get();
        foreach($order as $key => $ord){
            $cus_id = $ord->cus_id;
            $ship_id = $ord->ship_id;

        }
        $customer = customers::where('cus_id', $cus_id)->first();
        $shipping = shipping::where('ship_id', $ship_id)->first();
        $details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();
        foreach($details_product as $key => $order_d){
            $prod_coupon = $order_d->pord_coupon;
            
        }
        if($prod_coupon != 'does not exist'){
            $coupon = Coupon::where('coupon_code', $prod_coupon)->first();
            $coupon_feature = $coupon->coupon_feature;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_feature = 1;
            $coupon_number = 0;
        }
        $output = '';

        $output .='
                    <style>
                        body{
                            font-family: DejaVu Sans;
                        }
                        table, th, td {
                            border: 1px solid black;
                border-collapse: collapse;
                        }

                    </style>
                    <h1><center>BILL</center></h1>

                    <p>Customer Information</p>
                    <table >
                        <thead>
                            <tr>
                                <th width="200px">Customer Name</th>
                                <th width="180px">Phone Number</th>
                                <th width="250px">Email</th>
                            </tr>
                        </thead>
                        <tbody>';
        $output.='
                            <tr>
                                <td>'.$customer->cus_name.'</td>
                                <td>'.$customer->cus_phone.'</td>
                                <td>'.$customer->cus_email.'</td>
                            </tr>';
        $output.='
                        </tbody>
                    </table>
                    <p>Shipping Information</p>
                    <table >
                        <thead>
                            <tr>
                                <th width="150px">Shipping Name</th>
                                <th width="100px">Email</th>

                                <th width="50px">Phone Number</th>
                                <th width="100px">Address</th>
                                <th width="100px">Note</th>
                            </tr>
                        </thead>
                        <tbody>';
        $output.='
                            <tr>
                                <td>'.$shipping->ship_name.'</td>
                                <td>'.$shipping->ship_email.'</td>
                                
                                <td>'.$shipping->ship_phone.'</td>
                                 <td>'.$shipping->ship_address.'</td>
                                <td>'.$shipping->ship_note.'</td>
                            </tr>';
        $output.='
                        </tbody>
                    </table>
                    <p>Order Details</p>
                    <table >
                        <thead>
                            <tr>
                                <th width="300px">Product</th>
                                <th>Quantity</th>

                                <th width="100px">Price</th>
                                <th width="150px">Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>';
                            $i = 0;
                            $Total= 0;
                            $total_coupon = 0;
                            $total_a = 0;
                            foreach($details_product as $key => $prod){
                            $subtotal = $prod->prod_price*$prod->prod_sale_quantity;
                            $Total += $subtotal;
                                $output.='
                                <tr>
                                    <td>'.$prod->prod_name.'</td>
                                    <td>'.$prod->prod_sale_quantity.'</td>
                                    <td>'.number_format($prod->prod_price,0,',',',') .'</td>
                                    <td>'.number_format($subtotal,0,',',',').'</td>
                                </tr>';
                            }
                            $output.='            
                            <tr>
                                <td colspan=2> ';
                                    if($coupon_feature == 0){
                                        
                                        $total_a = ($Total*$coupon_number)/100;
                                        $total_coupon = $Total-$total_a+$prod->fee_ship;
                                    }else{
                                        $total_coupon = $Total-$coupon_number+$prod->fee_ship;
                                    }
                                    $output.='Sub Total:'.number_format($Total,0,',',',').'<br>Shipping Cost:'.number_format($prod->fee_ship,0,',',',');
                                    if($prod->pord_coupon != null){
                                        if($coupon_feature == 0){
                                            $output.='<br>Discount:'.$coupon_number.' %<br>Total Amount Reduced:'.
                                            number_format($total_a,0,',',',') ;
                                        }else{
                                            $output.='<br>Discount:'.number_format($coupon_number,0,',',',');
                                        }
                                    }else if($coupon_feature == 1){
                                        $output.='no coupon<br>';
                                    }
                                $output.='<br>Total:'.number_format($total_coupon,0,',',',').'<br></td>
                                <td>
         
                                    
                                     </td>
                                     <td>
         
                                    
                                     </td>
                            </tr>
                        </tbody>
                    </table>'; 
                    
        
        return $output;
    }

    public function Search_Order(Request $request){
        $key = $request->key_sub;
        $order = DB::table('orders')->where('order_code', 'like', '%'.$key.'%')->get();
        return view('admin.order.search_order')->with('order', $order);
    }

    public function unconfirmed($order_code){
        DB::table('orders')->where('order_code', $order_code)->update(['order_status'=>0]);
        Session::put('message', '
The order has been unconfirmed successfully.');
        return Redirect::to('/admin/Orders');
    } 
    public function confirm($order_code){
        DB::table('orders')->where('order_code', $order_code)->update(['order_status'=>1]);
        Session::put('message', '
The order has been confirmed successfully.');
        return Redirect::to('/admin/Orders');

    } 
}
