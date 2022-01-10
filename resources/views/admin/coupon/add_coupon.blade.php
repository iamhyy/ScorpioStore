@extends('admin_layout')
@section('cate_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Coupon
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
                                <form role="form" action="{{URL::to('/admin/AddCoupon/Save') }}" method ="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coupon Name</label>
                                    <input type="text" name ="coupon_name"class="form-control" id="exampleInputEmail1" placeholder="Enter Category Product Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Coupon Code</label>
                                    <input type="text" name="coupon_code"class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="text" name ="coupon_qty"class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Feature</label>
                                    <select name="coupon_feature" class="form-control input-sm m-bot15">
                                        <option value = "0">In Percent</option>
                                        <option value = "1">In Money</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Percent or Money</label>
                                    <input type="text" name="coupon_number"class="form-control" id="exampleInputEmail1">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection