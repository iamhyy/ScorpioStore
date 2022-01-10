@extends('admin_layout')
@section('cate_prod')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Add Category Product
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
                                <form role="form" action="{{URL::to('/admin/add-category/Save') }}" method ="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Product Name</label>
                                    <input type="text" name ="category_prod_name"class="form-control" id="exampleInputEmail1" placeholder="Enter Category Product Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Description</label>
                                    <textarea class="form-control" name ="category_prod_description"id="exampleInputEmail1" placeholder="Category Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Main</label>
                                    <select name="category_prod_main" class="form-control input-sm m-bot15">
                                        <option value = "1">TOPS</option>
                                        <option value = "2">BOTTOMS</option>
                                        <option value = "3">DRESSES</option>
                                        <option value = "4">OUTERWEAR</option>
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