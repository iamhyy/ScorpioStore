<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\FeeShip;

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city = City::orderby('matp', 'ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
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
    public function add_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new FeeShip();
        $fee_ship->city_id = $data['city'];
        $fee_ship->province_id = $data['province'];
        $fee_ship->wards_id = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }
    public function select_fee(){
        $feeship = FeeShip::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output.= '<div clas="table-responsive">
                    <table class="table table-bordered">
                        <thread>
                            <tr>
                                <th>City</th>
                                <th>Province</th>
                                <th>Wards</th>
                                <th>Fee</th>
                            </tr>
                        </thread>
                    <tbody>
                    ';
                    foreach($feeship as $key => $fee){
                        $output.= '
                        <tr>
                            <td>'.$fee->city->name_tp.'</td>
                            <td>'.$fee->province->name_qh.'</td>
                            <td>'.$fee->wards->name_xa.'</td>
                            <td contenteditable data-feeship_id=""class="fee_ship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                            <input type="hidden" value="'.$fee->fee_id.'" class ="fee_id"/>
                        </tr>
                        ';
                    }
                    $output.= '
                    </tbody>
                    </table>
                   </div>';
                   echo $output;
        
    }
    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = FeeShip::find('fee_id', $data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
