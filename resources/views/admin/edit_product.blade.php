@extends('admin_layout')
@section('cate_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Product Information
                        </header>
                        <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::put('message', null);
    }
    ?>
                        <div class="panel-body">
                            @foreach($edit_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/admin/update-product/'.$edit_value->prod_id) }}" method ="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" name ="prod_id"class="form-control" id="exampleInputEmail1" value="{{ $edit_value->prod_id }}">
                                    <label for="exampleInputEmail1">Product Name</label>

                                    <input type="text" name ="prod_name"class="form-control" id="exampleInputEmail1" value="{{ $edit_value->prod_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <textarea class="form-control" name ="prod_content"id="exampleInputEmail1"  id="ckeditor3">{{ $edit_value->prod_content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name ="prod_image"class="form-control" id="exampleInputEmail1" ><img src = "{{URL::to('/public/upload/product/'.$edit_value->prod_image )}}" height="85 " width="70"></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Price</label>
                                    <input type="text" class="form-control" name ="prod_price"id="exampleInputEmail1"value="{{ $edit_value->prod_price }}" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discount</label>
                                    <input type="text" class="form-control" name ="prod_discount"id="exampleInputEmail1" value="{{ $edit_value->prod_discount }}"></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quantity</label>
                                    <input type="text"class="form-control" name ="prod_quantity"id="exampleInputEmail1" value="{{ $edit_value->prod_quantity }}"></input>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category</label>
                                    <select name="prod_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_prod as $key => $cate)
                                        @if($cate->cate_id == $edit_value->cate_id)
                                            <option selected value="{{$cate->cate_id  }}">{{ $cate->cate_name }}</option>
                                        @else
                                            <option value="{{$cate->cate_id  }}">{{ $cate->cate_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand</label>
                                    <select name="prod_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_prod as $key => $brand)
                                        @if($cate->cate_id == $edit_value->cate_id)
                                            <option selected value="{{$brand->brand_id }}">{{ $brand->brand_name }}</option>
                                        @else
                                            <option value="{{$brand->brand_id }}">{{ $brand->brand_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
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