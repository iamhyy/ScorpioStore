<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function Add_Brand(){
        return view('admin.add_brand_product');
    }
    public function List_Brand(){
        $list_brand = DB::table('brands')->get();
        $manager = view('admin.manage_brand_product')->with('list_brand', $list_brand);
        return view('admin_layout')->with('admin.manage_brand_product', $manager);
    }
    public function Save_Brand(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_prod_name;
        $data['brand_desc'] = $request->brand_prod_description;
        $data['brand_status'] = $request->brand_prod_status;
        DB::table('brands')->insert($data);
        Session::put('message', 'successfully.');
        return Redirect::to('/admin/add-brand');
    }
    public function Active_Brand($brand_pro_id){
        DB::table('brands')->where('brand_id', $brand_pro_id)->update(['brand_status'=>0]);
        Session::put('message', '
The brand has been hidden successfully.');
        return Redirect::to('/admin/manage-brand');
    } 
    public function Unactive_Brand($brand_pro_id){
        DB::table('brands')->where('brand_id', $brand_pro_id)->update(['brand_status'=>1]);
        Session::put('message', '
The brand has been activated successfully.');
        return Redirect::to('/admin/manage-brand');

    } 
    public function Edit_Brand($brand_pro_id){
        $edit_brand = DB::table('brands')->where('brand_id', $brand_pro_id)->get();
        $manager = view('admin.edit_brand_product')->with('edit_brand', $edit_brand);
        return view('admin_layout')->with('admin.manage_brand_product', $manager);

    } 
    public function Delete_Brand($brand_pro_id){
        DB::table('brands')->where('brand_id', $brand_pro_id)->delete();
        Session::put('message', '
The brand has been deleted successfully.');
        return Redirect::to('/admin/manage-brand');

    } 
    public function Update_Brand(Request $request,$brand_pro_id){
        $data = array();
        $data['brand_name'] = $request->brand_prod_name;
        $data['brand_desc'] = $request->brand_prod_description;
        DB::table('brands')->where('brand_id', $brand_pro_id)->update($data);
         Session::put('message', '
The brand has been updated successfully.');
        return Redirect::to('/admin/manage-brand');
    }    

    //brand product in home
     public function show_brand_home($brand_id){
        $cate_prod = DB::table('category_product')->orderby('cate_id', 'desc')->get();
        $brand_prod = DB::table('brands')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('products')->join('brands','products.brand_id', '=', 'brands.brand_id')->where('products.brand_id', $brand_id)->where('prod_status', '1')->get();
        $brand_name = DB::table('brands')->where('brands.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category',$cate_prod)->with('brand', $brand_prod)->with('brand_id',  $brand_by_id)->with('brand_name', $brand_name);
    }

}
