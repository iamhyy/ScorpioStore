@extends('admin_layout')
@section('cate_prod')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Manage Comment
    </div>
    <div id="notify_reply"></div>
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
        <div class="input-group">
          <form method="post" action="{{URL::to('/admin/search-product') }}">@csrf
            <input type="text" class="input-sm form-control" placeholder="Search" name="key_sub">
            <span class="input-group-btn">
              <input class="btn btn-sm btn-default"    type="submit" value="Go!" >
            </span> 
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
            <th >Browse</th>
            <th>Product Name</th>
            <th>Name</th>
            <th>Comment</th>
            <th>Date</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key => $comment)
          <form>@csrf
          <tr>

            <td><span class="text-ellipsis">
              <input type="hidden" class="prod_id" value="{{  $comment->prod_id}}">
              <input type="hidden" class="comment_id" value="{{  $comment->comment_id}}">
              @if($comment->comment_status == 1)
                <input type="hidden" class="comment_status" value="0">
                <input type="button"  class=" btn btn-primary approved_btn" name="" value="approved">
              @else
                <input type="hidden" class="comment_status" value="1">
                <input type="button" class="btn btn-danger btn-sm btn-sm approved_btn" name="" value="not approved">
              @endif
            </span></td>
            <td><a href="{{ URL::to('/product-detail'.$comment->prod_id) }}" target="_blank"></a>{{ $prod_name->prod_name }}</td>
            <td>{{ $comment->comment_name }}</td>
            <td>{{ $comment->comment }}
              <ul>
                  @if($comment->comment_before == $comment->comment_id)
                    Reply: <li>{{ $reply->comment }}</li>
                  @endif
              </ul>
              @if($comment->comment_status == 1)
                <br/><textarea rows="3" style="resize: none;" class="form-control reply_comment"></textarea>
                <br/><input type="button" class="btn btn-default btn-xs btn_reply_comment" value="Reply">
              @endif
              
            </td>

            <td>{{ $comment->comment_date }}</td>
            
            
            
            <td>
              <a onclick= "return confirm('Are you sure to delete this product?')"href="" class="active" ui-toggle-class="">
                <i class="fa fa-trash-o text-danger text"></i></a>
            </td>
          </tr>
        </form>
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