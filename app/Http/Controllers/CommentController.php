<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\comment;
session_start();

class CommentController extends Controller
{
    public function comment(){
        $prod_name = DB::table('products')->join('comments','products.prod_id', '=', 'comments.prod_id')->first();
        $comment = comment::orderby('comment_status', 'ASC')->get();
        $reply = comment::where('comment_before','>',0)->get();
        return view('admin.comment.comment')->with(compact('comment', 'prod_name', 'reply'));
    }
    public function allow(Request $request){
        $data = $request->all();
        $comment = comment::find($data['comment_id']);
        $comment->comment_status = $data['status'];
        $comment->save();
    }

    public function reply(Request $request){
        $data = $request->all();
        $comment = new comment();
        $comment->comment_name = 'ScorpioStore';
        $comment->comment = $data['reply'];
        $comment->prod_id = $data['prod_id'];
        $comment->comment_status = 1;
        $comment->comment_before = $data['comment_id'];
        $comment->save();
    }
    public function load_comment(Request $request){
        $product_id = $request->prod_id;
        $comment = comment::where('prod_id',$product_id)->where('comment_status',1)->get();
        $output = '';
        foreach($comment as $key => $comm){
            if($comm->comment_before == 0){
                        $output.= ' 
            <div class="review">
          
                <p class="rating">
                    <i class="fa fa-star light-red"></i>
                    <i class="fa fa-star light-red"></i>
                    <i class="fa fa-star light-red"></i>
                    <i class="fa fa-star-half-o gray"></i>
                    <i class="fa fa-star-o gray"></i>
                </p>
                <h5 class="reviewer" style="color: red;">
                    @'.$comm->comment_name.'
                </h5>
                    <p class="review-date">
                '.$comm->comment_date.'
                </p>
                <p>'.
                $comm->comment.'</p>';
            }
                foreach($comment as $key => $reply){
                    if($reply->comment_before == $comm->comment_id){
                        $output .='
                    
                        <h5 class="reviewer" style="color: red;">
                            &nbsp&nbsp&nbsp&nbsp@'.$reply->comment_name.'
                        </h5>
                        <p>&nbsp&nbsp&nbsp&nbsp'.$reply->comment.'</p>';
                    }
                }
                $output.= '
                
            </div>';

                                    
        }
        echo $output;
    }
    public function send_comment(Request $request){
        $product_id = $request->prod_id;
        $comment_name = $request->name;
        $comment_content = $request->content;
        $comments = new comment();
        $comments->comment = $comment_content;
        $comments->comment_name = $comment_name;
        $comments->prod_id = $product_id;
        $comments->comment_status = 0;
        $comments->save();
    }
}
