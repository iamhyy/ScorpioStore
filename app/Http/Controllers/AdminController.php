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
class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }    
    public function AuthLogin(){
        if(Session::get('login_normal')){
            $admin_id == Session::get('admin_id');
        }else{
            $admin_id = Auth::id();
        }
        if($admin_id){
            return Redirect::to('/admin/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    public function show_dashboard(){
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $email = $request->admin_email;
        $password = $request->admin_password;
        $result = DB::table('admin')->where('admin_email', $email)->where('admin_password', $password)->first();
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            Session::put('admin_role',$result->admin_role);
            return Redirect::to('/admin/admin-dashboard');
            }
        else{
            Session::put('message', 'Invalid password or email.');
            return Redirect::to('/admin');
        }
        
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }


    //login facebook
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id',$account->user)->first();
            Session::put('admin_name',$account_name->admin_name);
 Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }else{

            $hieu = new social([
                'provider_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => ''

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = Login::where('admin_id',$account->user)->first();

            Session::put('admin_name',$account_name->admin_name);
             Session::put('admin_id',$account_name->admin_id);
            return redirect('/admin/admin-dashboard')->with('message', 'Đăng nhập Admin thành công');
        } 
    }


    //login gg
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        if($authUser){
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->admin_id);
        }elseif($new){
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('login_normal',true);
            Session::put('admin_id',$account_name->admin_id);
        }
        return redirect('admin/admin-dashboard')->with('message', 'Đăng nhập Admin thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }else{
            $new = new Social([
            'provider_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('admin_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',

                    'admin_phone' => '',
                    'admin_status' => 1
                ]);
            }
        $new->login()->associate($orang);
        $new->save();

        return $new;
        }

    }

    

    

}
