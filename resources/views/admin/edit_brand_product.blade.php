@extends('admin_layout')
@section('brand_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Brand Product Information
                        </header>
                        <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::put('message', null);
    }
    ?>
                        <div class="panel-body">
                            @foreach($edit_brand as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/admin/update-brand/'.$edit_value->brand_id) }}" method ="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" value ="{{ $edit_value->brand_name }}"name ="brand_prod_name"class="form-control" id="exampleInputEmail1" placeholder="Enter Brand Product Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand Description</label>
                                    <textarea class="form-control" 
                                    name ="brand_prod_description"id="exampleInputEmail1" >{{ $edit_value->brand_desc }}</textarea>
                                </div>
                              
                                
                                <button type="submit" class="btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp Save</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection