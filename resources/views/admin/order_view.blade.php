@extends('admin_layout')
@section('order')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Order Detail Table
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
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        <?php
            $i = 0;
            $Total= 0;
            $total_coupon = 0;
                $total_a = 0;
          ?>
          @foreach($details_product as $key => $detail)
          <?php
          $i++;
          $subtotal = $detail->prod_price*$detail->prod_sale_quantity;
          $Total += $subtotal;
          ?>
          <tr>
          <td>{{$i}}</td>
            
            <td>{{$detail->prod_name }}</td>
            <td>{{$detail->prod_sale_quantity }}</td>
            <td>{{number_format($detail->prod_price,0,',',',') }}</td>
            <td>{{number_format($subtotal,0,',',',')}}</td>
            
            <td><span class="text-ellipsis">
            
          
          @endforeach
          </tr>
          <tr>
            
          
            <td colspan=3> 
              
              @if($coupon_feature == 0)
              <?php
              
                $total_a = ($Total*$coupon_number)/100;
                $total_coupon = $Total-$total_a+$detail->fee_ship;
                ?>
              @else
              <?php
                $total_coupon = $Total-$coupon_number+$detail->fee_ship;

                ?>
              @endif
              <?php $total_cou = $total_coupon?>
              Sub Total:{{number_format($Total,0,',',',')}}<br>
              Shipping Cost: {{number_format($detail->fee_ship,0,',',',')}}<br>
              Total:{{number_format($total_cou,0,',',',')}}<br>
            </td>
            <td>
         
              @if($detail->pord_coupon)
                @if($coupon_feature ==0)
                  Coupon:{{$detail->pord_coupon}}<br>
                  Discout: {{$coupon_number}}<br>
                  Total Amount Reduced: {{number_format($total_a,0,',',',')  }}
                @else
                  Coupon:{{$detail->pord_coupon}}<br>
                  Discout: {{number_format($coupon_number,0,',',',')}}
                @endif
              @else
                no coupon
              @endif

            </td>
          </tr>
        </tbody>
      </table>
      <a target="_blank" href="{{URL::to('/admin/PrintOrders/'.$detail->order_code)}}">Print</a>
    </div>
    
</div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Customer Information
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
            
            <th>Customer name</th>
            <th>Phone number</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            
            <td>{{$customer->cus_name }}</td>
            <td>{{$customer->cus_phone }}</td>
            <td>{{$customer->cus_email }}</td>
          </tr>
        
        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
  <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Shipping Information
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
            
            <th>Shipping name</th>
            <th>Phone number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Note</th>
            <th>Ship Method</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            
            <td>{{ $shipping->ship_name }}</td>
            <td>{{ $shipping->ship_email}}</td>
            <td>{{ $shipping->ship_address }}</td>
            <td>{{ $shipping->ship_phone }}</td>
            <td>{{ $shipping->ship_note}}</td>
            <td>
              @if($shipping->ship_method == 0)
                Direct Bank Transfer
              @elseif($shipping->ship_method == 1)
                Check Payment
              @else
                Paypal
              @endif
            </td>
          </tr>
        
        </tbody>
      </table>
    </div>

  </div>

@endsection