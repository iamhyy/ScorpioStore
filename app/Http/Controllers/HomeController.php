<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Mail;
use App\Models\comment;
use App\Models\category;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    
    
    public function index(Request $request){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $prod = DB::table('products')->where('prod_status', '0')->orderby('prod_id', 'desc')->limit(8)->get();
        $hot_prod = DB::table('products')->where('prod_status', '1')->orderby('prod_quantity', 'desc')->limit(12)->get();
        return view('pages.home')->with('category',$cate_prod)->with('brand', $brand_prod)->with('prod', $prod)->with('hot_prod', $hot_prod);

    }
    public function search(Request $request){
        $key = $request->key_sub;
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $search = DB::table('products')->where('prod_name', 'like', '%'.$key.'%')->get();
        return view('pages.product.search')->with('category',$cate_prod)->with('brand', $brand_prod)->with('search', $search);
    }


    public function send_mail(){
         $to_name = "Scorpio Store";
        $to_email = "mandoanhy@gmail.com";//send to this email
        $data = array("name"=>"Email from customers account","body"=>"noi dung body"); //body of mail.blade.php
            
        Mail::send('pages.email.send_mail',$data,function($message) use ($to_name,$to_email){
        $message->to($to_email)->subject('testemail');//send this mail with subject
        $message->from($to_email,$to_name);//send from this mail
                });
        return Redirect::to('');

    }
    public function load_menu(){
        $category = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $output = '';
            $output .= '
                <div class="col-md-3 col-sm-6">
                    <ul class="mega-menu-links">
                        <li>Outerwear</li>
                        <div class="col-md-6 col-sm-6 " style="padding-left: 0;"><hr style="width: 60px;    padding-left: 0;"></div>';
                        
                            foreach($category as $key => $cate){
                                if($cate->cate_main == 4){
                                    $output .= '<li><a href="/ScorpioStore/category-product/'.$cate->cate_id .'">'.$cate->cate_name.'</a></li>';
                                }
                            }
        $output .= '</ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="mega-menu-links">
                        <li>Tops</li>
                        <div class="col-md-6 col-sm-6 " style="padding-left: 0;"><hr style="width: 60px;    padding-left: 0;"></div>';
                            foreach($category as $key => $cate){
                                if($cate->cate_main == 1){
                                    $output .= '<li><a href="/ScorpioStore/category-product/'.$cate->cate_id .'">'.$cate->cate_name.'</a></li>';
                                }
                            }
        $output .= '</ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="mega-menu-links">
                        <li>Outerwear</li>
                        <div class="col-md-6 col-sm-6 " style="padding-left: 0;"><hr style="width: 60px;    padding-left: 0;"></div>';
                            foreach($category as $key => $cate){
                                if($cate->cate_main == 2){
                                    $output .= '<li><a href="/ScorpioStore/category-product/'.$cate->cate_id .'">'.$cate->cate_name.'</a></li>';
                                }
                            }
        $output .= '</ul>
                </div>
                <div class="col-md-3 col-sm-6">
                    <ul class="mega-menu-links">
                        <li>Tops</li>
                        <div class="col-md-6 col-sm-6 " style="padding-left: 0;"><hr style="width: 60px;    padding-left: 0;"></div>';
                        foreach($category as $key => $cate){
                            if($cate->cate_main == 3){
                                $output .= '<li><a href="/ScorpioStore/category-product/'.$cate->cate_id .'">'.$cate->cate_name.'</a></li>';
                            }
                        }
        $output .= '</ul>
                </div>';   
        
        return $output;
    }
    public function detail_product($prod_id){
        $cate_prod = category::orderby('cate_id', 'desc')->get();
        $cate_n = category::orderby('cate_id', 'desc')->get();
        $special = DB::table('products')->where('prod_discount','>',0 )->limit(3)->get();
        $detail_prod =  DB::table('products')->join('category_product','products.cate_id', '=', 'category_product.cate_id') ->join('brands','products.brand_id', '=', 'brands.brand_id')->where('products.prod_id', $prod_id)->get();
        $id =  DB::table('products')->join('category_product','products.cate_id', '=', 'category_product.cate_id') ->join('brands','products.brand_id', '=', 'brands.brand_id')->where('products.prod_id', $prod_id)->first();
            $category_id = $id->cate_id;
        
        
        $relate =  DB::table('products')
        ->join('category_product','products.cate_id', '=', 'category_product.cate_id')
        ->join('brands','products.brand_id', '=', 'brands.brand_id')
        ->where('category_product.cate_id', $category_id)->whereNotIn('products.prod_id', [$prod_id])->limit(6)->get();

        $comment = comment::where('prod_id',$prod_id)->get();
        return view('pages.product.detail_product')->with('category',$cate_prod)->with('prod_detail', $detail_prod)->with('vl_relate', $relate)->with('comment',$comment)->with('special', $special)->with('cate_n', $cate_n);

    }
}
