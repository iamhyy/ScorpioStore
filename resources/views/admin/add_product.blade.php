@extends('admin_layout')
@section('brand_prod')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Product
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
                                <form role="form" action="{{URL::to('/admin/add-product/Save') }}" method ="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" name ="prod_name"class="form-control" id="exampleInputEmail1" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Content</label>
                                    <textarea  class="form-control" name ="prod_content" id="ckeditor1" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name ="prod_image"class="form-control" id="exampleInputEmail1" placeholder="Choose image"></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Price</label>
                                    <input type="text" class="form-control" name ="prod_price"id="exampleInputEmail1" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Discount</label>
                                    <input type="text" class="form-control" name ="prod_discount"id="exampleInputEmail1" ></input>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quantity</label>
                                    <input type="text"class="form-control" name ="prod_quantity"id="exampleInputEmail1" ></input>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Status</label>
                                    <select name="prod_status" class="form-control input-sm m-bot15">
                                        <option value = "0">Hide</option>
                                        <option value = "1">Dispay</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category</label>
                                    <select name="prod_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_prod as $key => $cate)
                                        <option value="{{$cate->cate_id  }}">{{ $cate->cate_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Brand</label>
                                    <select name="prod_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_prod as $key => $brand)
                                        <option value="{{$brand->brand_id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
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