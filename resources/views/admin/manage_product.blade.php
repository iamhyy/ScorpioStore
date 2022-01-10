@extends('admin_layout')
@section('cate_prod')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Product
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <button class="btn btn-default" type="button" ><a href="{{ URL::to('/admin/add-product') }}" style="color: crimson;"><i class="fa fa-plus" aria-hidden="true"></i> Create new product</a></button>             
      </div>
      <div class="col-sm-4">

      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <form method="post" action="{{URL::to('/admin/search-product') }}">@csrf
            <input type="text" class="input-sm " placeholder="Search" name="key_sub">
              <input class="btn btn-sm btn-default"    type="submit" value="Go!" >
          </form>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
    $message = Session::get('message');
    if($message){
        echo $message;
        Session::put('message', null);
    }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              ID
            </th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Content</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Quantity</th>
            <th style="width:70px;">Status</th>
            <th>Category</th>
            <th>Brand</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_product as $key => $product)
          <tr>
            <td>{{ $product->prod_id }}</td>
            <td>{{ $product->prod_name }}</td>
            <td><img src = "{{URL::to('/public/upload/product/'.$product->prod_image )}}" height="85 " width="70"> </td>
            <td>{{ $product->prod_content }}</td>
            <td>{{ $product->prod_price }}</td>
            <td>{{ $product->prod_discount }}</td>
            <td>{{ $product->prod_quantity }}</td>
            
            <td><span class="text-ellipsis">
              
              @if($product->prod_status == 1)
                <a href ="{{URL::to('/admin/manage-product/active/'.$product->prod_id)}}"><span class = "fa-circle-s fa fa-check"></span></a>
              @else
                <a href ="{{URL::to('/admin/manage-product/unactive/'.$product->prod_id)}}"><span class = "fa-circle-so fa fa-close"></span></a>
              @endif
            </span></td>
            <td>{{ $product->cate_name }}</td>
            <td>{{ $product->brand_name}}</td>
            <td>
              <a href="{{URL::to('/admin/edit-product/'.$product->prod_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this product?')"href="{{URL::to('/admin/delete-product/'.$product->prod_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class ="panal-footer">
      <div class="row">
        <div class="col-sm-5 text-center">
          <small class = 'text-muted inline m-t-sm m-b-sm'>showing 20-30 of 50 items</small>
        </div>   
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
  </div>
</div>
@endsection