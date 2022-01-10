@extends('admin_layout')
@section('cate_prod')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Category Product 
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
        <button class="btn btn-default" type="button" ><a href="{{ URL::to('/admin/add-category') }}" style="color: crimson;"><i class="fa fa-plus" aria-hidden="true"></i> Create new category</a></button>
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
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Category Name</th>
            <th>Description</th>
            <th >Category Main</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($list_category as $key => $cate_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $cate_pro->cate_name }}</td>
            <td>{{ $cate_pro->cate_desc }}</td>
            @if($cate_pro->cate_main == 1)
              <td>TOPS</td>
            @elseif($cate_pro->cate_main == 2)
              <td>BOTTOMS</td>
            @elseif($cate_pro->cate_main == 3)
              <td>DRESSES</td>
            @else
              <td>OUTERWEAR</td>
            @endif
            <td>
              <a href="{{URL::to('/admin/edit-category/'.$cate_pro->cate_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this category?')"href="{{URL::to('/admin/delete-category/'.$cate_pro->cate_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class ="panal-footer">
      
  </div>

@endsection