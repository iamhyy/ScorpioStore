@extends('admin_layout')
@section('brand_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Brand Product
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
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" name ="brand_prod_name"class="form-control" id="exampleInputEmail1" placeholder="Enter Category Product Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand Description</label>
                                    <textarea class="form-control" name ="brand_prod_description"id="exampleInputEmail1" placeholder="Brand Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Status</label>
                                    <select name="brand_prod_status" class="form-control input-sm m-bot15">
                                        <option value = "0">Hide</option>
                                        <option value = "1">Dispay</option>
                                    </select>
                                </div>
                                
                                <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp Save</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection