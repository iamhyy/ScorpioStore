<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    //admin page
    public function Add_Category(){
        return view('admin.add_Category_Product');
    }
    public function List_Category(){
        $list_category = DB::table('category_product')->get();
        $manager = view('admin.list_category_product')->with('list_category', $list_category);
        return view('admin_layout')->with('admin.list_category_product', $manager);
    }
    public function Save_Category(Request $request){
        $data = array();
        $data['cate_name'] = $request->category_prod_name;
        $data['cate_desc'] = $request->category_prod_description;
        $data['cate_status'] = $request->category_prod_main;
        DB::table('category_product')->insert($data);
        Session::put('message', 'successfully.');
        return Redirect::to('/admin/add-category');
    }
    public function Active_Category($cate_pro_id){
        DB::table('category_product')->where('cate_id', $cate_pro_id)->update(['cate_status'=>0]);
        Session::put('message', '
The category has been hidden successfully.');
        return Redirect::to('/admin/list-category');
    } 
    public function Unactive_Category($cate_pro_id){
        DB::table('category_product')->where('cate_id', $cate_pro_id)->update(['cate_status'=>1]);
        Session::put('message', 'The category has been activated successfully.');
        return Redirect::to('/admin/list-category');

    } 
    public function Edit_Category($cate_pro_id){
        $edit_category = DB::table('category_product')->where('cate_id', $cate_pro_id)->get();
        $manager = view('admin.edit_category_product')->with('edit_category', $edit_category);
        return view('admin_layout')->with('admin.list_category_product', $manager);

    } 
    public function Delete_Category($cate_pro_id){
        DB::table('category_product')->where('cate_id', $cate_pro_id)->delete();
        Session::put('message', 'The category has been deleted successfully.');
        return Redirect::to('/admin/list-category');

    } 
    public function Update_Category(Request $request,$cate_pro_id){
        $data = array();
        $data['cate_name'] = $request->category_prod_name;
        $data['cate_desc'] = $request->category_prod_description;
        DB::table('category_product')->where('cate_id', $cate_pro_id)->update($data);
         Session::put('message', 'The category has been updated successfully.');
        return Redirect::to('/admin/list-category');
    } 


    //page category home
    public function show_cate_home($cate_id){
        $cate_prod = DB::table('category_product')->where('cate_status', '1')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $cate_by_id = DB::table('products')->join('category_product','products.cate_id', '=', 'category_product.cate_id')->where('products.cate_id', $cate_id)->where('prod_status', '1')->get();
        $cate_name = DB::table('category_product')->where('category_product.cate_id', $cate_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category',$cate_prod)->with('brand', $brand_prod)->with('cate_id',  $cate_by_id)->with('cate_name', $cate_name);
    }

}
