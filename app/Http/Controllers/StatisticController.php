<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use DB;
use Excel;
use Carbon\Carbon;
use Validator;
use App\Models\social;
use Socialite;
use App\Models\Login;
use App\Models\statistic;
use App\Models\admin;
use Session;

class StatisticController extends Controller
{
    //statistic
    public function statistic(){
        $val = DB::table('products') ->select('brand_name', DB::raw('SUM(prod_quantity) as total_sales'))->join('brands', 'products.brand_id' , 'brands.brand_id')->groupBy('brand_name')->get();
        $val2 = DB::table('products') ->select('cate_name', DB::raw('SUM(prod_quantity) as total_sales'))->join('category_product', 'products.cate_id' , 'category_product.cate_id')->groupBy('cate_name')->get();
        
        return view('admin.statistic')->with(compact('val','val2'));
    }

    public function filter_day(Request $request){
        
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();        
        foreach($get as $key => $val){
            $chart_data = array();
            $chart_data['period'] =  $val->order_date;
            $chart_data['order'] = $val->order_total;
            $chart_data['sales'] = $val->sales;
            $chart_data['profit'] = $val->profit;
            $chart_data['quantity'] = $val->quantity;
       }
       echo $data = json_encode($chart_data);

    }

    public function days_order(){

        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $get = statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();


        foreach($get as $key => $val){

           $chart_data[] = array(
            'period' => $val->order_date,
            'order' => $val->order_total,
            'sales' => $val->sales,
            'profit' => $val->profit,
            'quantity' => $val->quantity
        );

       }

       echo $data = json_encode($chart_data);
    }

    public function filter_statistic(Request $request){
        $data = $request->all();
        $fmonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $flmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $elmonth = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365day = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['value'] == '7day'){
            $get = statistic::whereBetween('order_date', [$sub7day, $now])->orderBy('order_date', 'ASC')->get();
        }
        elseif($data['value'] == 'lmonth'){
            $get = statistic::whereBetween('order_date', [$flmonth, $elmonth])->orderBy('order_date', 'ASC')->get();
        }
        elseif($data['value'] == 'tmonth'){
            $get = statistic::whereBetween('order_date', [$fmonth, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->order_total,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function export_excel(){
        return Excel::download(new ExcelExport , 'statistic.xlsx');
    }

}
