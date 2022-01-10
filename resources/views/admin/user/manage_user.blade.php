@extends('admin_layout')
@section('user')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage User
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-4">
        <button class="btn btn-default" type="button" ><a href="{{ URL::to('/admin/AddUser') }}" style="color: crimson;"><i class="fa fa-plus" aria-hidden="true"></i> Create new user</button>
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
            <th>User name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Role</th>
            <th style="width:70px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $key => $vl)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $vl->admin_name }}</td>
            <td>{{ $vl->admin_email }}</td>
            <td>{{ $vl->admin_password }}</td>
            <td>{{ $vl->admin_phone }}</td>
              @if($vl->admin_role == 0)
                <td>Administrator</td>
              @elseif($vl->admin_role == 1)
                <td>Employee</td>
              @else
                <td>Accountant</td>
              @endif
            <td>
              <a href="{{URL::to('/admin/edituser/'.$vl->admin_id) }}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
              <a onclick= "return confirm('Are you sure to delete this brand?')"href="{{URL::to('/admin/delete-user/'.$vl->admin_id) }}" class="active" ui-toggle-class="">
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