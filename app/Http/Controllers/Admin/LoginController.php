<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use Validator;

class LoginController extends Controller
{
    //登录页面
    public function login(){
        return view("admin.login");
    }
    //处理用户登录
    public function doLogin(Request $request){
        // dd(123);
        $input=$request->except("_token");
        $rules=[
            'username'=>"required|between:4,18",
            "password"=>"required|between:6,18|alpha_dash",
            "vericode"=>"required|captcha"
        ];
        $msg=[
            'username.required'=>"用户名必须输入",
            'username.between'=>"用户名长度必须在4-18位之间",
            'password.required'=>"密码必须输入",
            'password.between'=>"密码长度必须在6-18位之间",
        ];
        $validator=Validator::make($input,$rules,$msg);
        if($validator->fails()){
            return redirect("admin/login")
            ->withErrors($validator)
            ->withInput();
        }
        //验证用户存在
        // $user=User::where("user_name",$input['username'])->first();
        $user=DB::table("user")->where('user_name',"=",$input['username'])->first();
        if(!$user){
            return redirect("admin/login")->with("errors","用户名错误");
        }
        // $hash=Hash::make($input['password']);
        // dd($hash,$user->user_pass);
        if(!Hash::check($input['password'],$user->user_pass)){
            return redirect("admin/login")->with("errors","密码错误");

        }
        // dd(123);
        //保存用户信息到session中
        session()->put("user",$user);
        //跳转到后台首页
        return redirect("admin/index");
    }
    //进行md5加密
    public function do_md5(){

    }
}
