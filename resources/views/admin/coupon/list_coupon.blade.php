@extends('admin_layout')
@section('order')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Coupon
    </div>
    <div class="row w3-res-tb">
            <div class="col-sm-4">
            <button class="btn btn-default" type="button" ><a href="{{ URL::to('/admin/AddCoupon') }}" style="color: crimson;"><i class="fa fa-plus" aria-hidden="true"></i> Create new coupon</a></button>
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
            
            <th>Coupon Name</th>
            <th>Coupon Code</th>
            <th>Quantity</th>
            <th>Feature</th>
            <th>Number</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as $key => $cou)
          <tr>
             <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_qty }}</td>
            <td><span class="text-ellipsis">
              
              @if($cou->coupon_feature == 0)
                In Percent
              @else
                In Money
              @endif
            </span></td>
            <td><span class="text-ellipsis">
              
              @if($cou->coupon_feature == 0)
                {{ $cou->coupon_number }} %
              @else
                {{ $cou->coupon_number }} đ
              @endif
            </span></td>

            <td>
              <a href="{{URL::to('/admin/edit-coupon/'.$cou->coupon_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this coupon?')"href="{{URL::to('/admin/DeleteCoupon/'.$cou->coupon_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    
  </div>

@endsection