@extends('admin_layout')
@section('order')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Orders 
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group ">
          <form method="post" action="{{URL::to('/admin/SearchOrder') }}">@csrf
            <input type="text" class="input-sm " placeholder="Search"  name="key_sub">
            
              <button class="btn btn-sm btn-default" type="submit">Go!</button>
            
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
            <th >Serial</th>
            <th>Order Code </th>
            <th>Order Status</th>
            <th>Order Total</th>
            <th>Order Date</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 0;
          ?>
          @foreach($order as $key => $ord)
          <?php
          $i++;
          ?>
          <tr>
            <td>{{$i}}</td>
            <td>{{ $ord->order_code }}</td>
            <td><span class="text-ellipsis">
              
            @if($ord->order_status == 1)
                <button type="submit" class="btn btn-success"><a href="{{URL::to('/admin/Orders/unconfirmed/'.$ord->order_code) }}" class="active" ui-toggle-class="">Confirmed order</a></button>
                @else
                <button type="submit" class="btn btn-warning"><a href="{{URL::to('/admin/Orders/confirm/'.$ord->order_code) }}" class="active" ui-toggle-class="">New order</a></button>
              @endif
            </span></td>
            <td>{{ $ord->order_total }}</td>
            <td>{{ $ord->order_day }}</td>
            <td>
              <a href="{{URL::to('/admin/ViewOrders/'.$ord->order_code) }}" class="active" ui-toggle-class=""><i class="fa fa-eye"></i></a>
              <a onclick= "return confirm('Are you sure to delete this order?')"href="{{URL::to('/admin/delete-order/'.$ord->order_id) }}" class="active" ui-toggle-class="">
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