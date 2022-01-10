@extends('admin_layout')
@section('brand_prod')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Brand
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <button class="btn btn-default" type="button" ><a href="{{ URL::to('/admin/add-brand') }}" style="color: crimson;"><i class="fa fa-plus" aria-hidden="true"></i> Create new brand</a></button>             
      </div>
    </div>
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
            
            <th>Brand</th>
            <th>Description</th>
            <th style="width:70px;">Status</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_brand as $key => $brand_pro)
          <tr>
            <td>{{ $brand_pro->brand_name }}</td>
            <td>{{ $brand_pro->brand_desc }}</td>
            <td><span class="text-ellipsis">
              
              @if($brand_pro->brand_status == 1)
                <a href ="{{URL::to('/admin/manage-brand/active/'.$brand_pro->brand_id)}}"><span class = "fa-circle-s fa fa-check"></span></a>
              @else
                <a href ="{{URL::to('/admin/manage-brand/unactive/'.$brand_pro->brand_id)}}"><span class = "fa-circle-so fa fa-close"></span></a>
              @endif
            </span></td>
            <td>
              <a href="{{URL::to('/admin/edit-brand/'.$brand_pro->brand_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this brand?')"href="{{URL::to('/admin/delete-brand/'.$brand_pro->brand_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class ="panal-footer">
      
  </div>
</div>
@endsection