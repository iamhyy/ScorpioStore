@extends('admin_layout')
@section('brand_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Delivery
                        </header>
                        <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::put('message', null);
    }
    ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/admin/add-brand/Save') }}" method ="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">City</label>
                                    <select name="city" id="city"  class="form-control input-sm m-bot15 choose city">
                                        <option disabled selected hidden value = "">--Choose City--</option>
                                        @foreach($city as $key => $ci)
                                        <option value = "{{ $ci->matp }}">{{ $ci->name_tp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Province</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                        <option disabled selected hidden value = "">--Choose Province--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Wards</label>
                                    <select name="wards"
                                    id="wards" class="form-control input-sm m-bot15 wards">
                                        <option disabled selected hidden value = "">--Choose Wards--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fee Ship</label>
                                    <input type="text" name ="fee_ship"class="form-control fee_ship" id="fee_ship" placeholder="Enter Category Product Name">
                                </div>
                                <button type="button" class="btn btn-info add_delivery" name="add_delivery">Submit</button>
                            </form>
                            </div>

                            <div id = "load_delivery">
                                
                            </div>

                        </div>
                    </section>

            </div>
        
@endsection