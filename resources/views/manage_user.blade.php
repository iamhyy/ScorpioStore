@extends('admin_layout')
@section('user')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage User
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
            <th>User name</th>
            <th>Phone</th>
            <th>Role</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $key => $vl)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $vl->admin_name }}</td>
            <td>{{ $vl->admin_email }}</td>
              
              @if($vl->admin_role == 0)
                <td>Administrator</td>
              @elseif($vl->admin_role == 1)
                <td>Employee</td>
              @else
                <td>Accountant</td>
              @endif
            <td>
              <a href="{{URL::to('/admin/edituser/'.$vl->admin_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this brand?')"href="{{URL::to('/admin/delete-brand/'.$vl->admin_id) }}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
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