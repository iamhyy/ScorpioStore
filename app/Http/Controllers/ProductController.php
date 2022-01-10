<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\comment;
session_start();


class ProductController extends Controller
{
    public function Add_Product(){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->orderby('brand_id', 'desc')->get();
        
        return view('admin.add_product')->with('cate_prod', $cate_prod)->with('brand_prod', $brand_prod);
    }
    public function List_Product(){
        $list_product = DB::table('products')->join('category_product','products.cate_id', '=', 'category_product.cate_id')->join('brands','products.brand_id', '=', 'brands.brand_id')->orderBy('products.prod_id', 'DESC')->get();
        $manager = view('admin.manage_product')->with('list_product', $list_product);
        return view('admin_layout')->with('admin.manage_product', $manager);
    }
    public function Save_Product(Request $request){
        $data = array();
        $data['prod_name'] = $request->prod_name;
        $data['prod_content'] = $request->prod_content;
        $data['prod_price'] = $request->prod_price;
        $data['prod_discount'] = $request->prod_discount;
        $data['prod_quantity'] = $request->prod_quantity;
        $data['prod_size'] = $request->prod_size;
        $data['prod_color'] = $request->prod_color;
        $data['prod_status'] = $request->prod_status;
        $data['cate_id'] = $request->prod_cate;
        $data['brand_id'] = $request->prod_brand;
        $image = $request->file('prod_image');
        if($image){
            $get_name = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name));
            $new_i = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
            $image->move('public/upload/product', $new_i);
            $data['prod_image'] = $new_i;
            if(empty($data['prod_name']) || empty($data['prod_content']) || empty($data['prod_price']) || empty($data['prod_quantity']) ) {
                Session::put('message', 'Please enter full information!');
                return Redirect::to('/admin/add-product');
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_price'])){
                Session::put('message', 'The price you entered is not valid!');
                return Redirect::to('/admin/add-product');
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_quantity'])){
                Session::put('message', 'The quantity you entered is not valid!');
                return Redirect::to('/admin/add-product');
            }else{
                DB::table('products')->insert($data);
                Session::put('message', 'The product has been added successfully.');
                return Redirect::to('/admin/manage-product');
            }
            
        
        }


        $data['prod_image'] = '';
        if(empty($data['prod_name']) || empty($data['prod_content']) || empty($data['prod_price']) || empty($data['prod_quantity']) ){
                Session::put('message', 'Please enter full information!');
                return Redirect::to('/admin/add-product');
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_price'])){
                Session::put('message', 'The price you entered is not valid!');
                return Redirect::to('/admin/add-product');
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_quantity'])){
                Session::put('message', 'The quantity you entered is not valid!');
                return Redirect::to('/admin/add-product');
            }else{
                DB::table('products')->insert($data);
                Session::put('message', 'The product has been added successfully.');
                return Redirect::to('/admin/manage-product');
            }
    }
    public function Active_Product($prod_id){
        DB::table('products')->where('prod_id', $prod_id)->update(['prod_status'=>0]);
        Session::put('message', '
The product has been hidden successfully.');
        return Redirect::to('/admin/manage-product');
    } 
    public function Unactive_Product($prod_id){
        DB::table('products')->where('prod_id', $prod_id)->update(['prod_status'=>1]);
        Session::put('message', '
The product has been activated successfully.');
        return Redirect::to('/admin/manage-product');

    } 
    public function Edit_Product($prod_id){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->orderby('brand_id', 'desc')->get();
        $edit_product = DB::table('products')->where('prod_id', $prod_id)->get();
        $manager = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_prod', $cate_prod)->with('brand_prod', $brand_prod);
        return view('admin_layout')->with('admin.manage_product', $manager);

    } 
    public function Delete_Product($prod_id){
        DB::table('products')->where('prod_id', $prod_id)->delete();
        Session::put('message', '
The product has been deleted successfully.');
        return Redirect::to('/admin/manage-product');

    } 
    public function Update_Product(Request $request,$prod_id){
        $data = array();
        $data['prod_id'] = $request->prod_id;
        $data['prod_name'] = $request->prod_name;
        $data['prod_content'] = $request->prod_content;
        $data['prod_price'] = $request->prod_price;
        $data['prod_discount'] = $request->prod_discount;
        $data['prod_quantity'] = $request->prod_quantity;
        $data['prod_size'] = $request->prod_size;
        $data['prod_color'] = $request->prod_color;
        $data['prod_status'] = $request->prod_status;
        $data['cate_id'] = $request->prod_cate;
        $data['brand_id'] = $request->prod_brand;
        $image = $request->file('prod_image');
        if($image){
            $get_name = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name));
            $new_i = $name_image.rand(0,99).'.'.$image->getClientOriginalExtension();
            $image->move('public/upload/product', $new_i);
            $data['prod_image'] = $new_i;
            if(empty($data['prod_name']) || empty($data['prod_content']) || empty($data['prod_price']) || empty($data['prod_quantity']) ) {
                Session::put('message', 'Please enter full information!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_price'])){
                Session::put('message', 'The price you entered is not valid!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_quantity'])){
                Session::put('message', 'The quantity you entered is not valid!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }else{
                DB::table('products')->where('prod_id', $prod_id)->update($data);
                Session::put('message', 'The product has been updated successfully.');
                return Redirect::to('/admin/manage-product');
            }
            
        }
        if(empty($data['prod_name']) || empty($data['prod_content']) || empty($data['prod_price']) || empty($data['prod_quantity']) ) {
                Session::put('message', 'Please enter full information!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_price'])){
                Session::put('message', 'The price you entered is not valid!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }elseif(!preg_match ("/^[0-9]*$/", $data['prod_quantity'])){
                Session::put('message', 'The quantity you entered is not valid!');
                return Redirect::to('/admin/edit-product/'.$data['prod_id']);
            }else{
                DB::table('products')->where('prod_id', $prod_id)->update($data);
                Session::put('message', 'The product has been updated successfully.');
                return Redirect::to('/admin/manage-product');
            }
    }  

    //product on brand
    

    public function Search_Product(Request $request){
        $key = $request->key_sub;
        $search = DB::table('products')->join('category_product','products.cate_id', '=', 'category_product.cate_id')->join('brands','products.brand_id', '=', 'brands.brand_id')->where('prod_name', 'like', '%'.$key.'%')->get();
        return view('admin.product.search_product')->with('search', $search);
    }

    
    
}
