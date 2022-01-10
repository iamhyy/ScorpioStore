<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Auth;
use App\Rules\Captcha;
use Validator;
use App\Models\social;
use Socialite;
use App\Models\Login;
use App\Models\statistic;
use App\Models\admin;
use Carbon\Carbon;

class UserController extends Controller
{
    public function show_user(){
        $user = admin::orderby('admin_id','DESC')->get();
        return view('admin.user.manage_user')->with(compact('user'));

    }
    public function delete_user($user_id){
        DB::table('admin')->where('admin_id', $user_id)->delete();
        Session::put('message', '
The user has been deleted successfully.');
        return Redirect::to('/admin/manage-user');

    } 
}
