<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'validation.captcha'=>"验证码错误",
        ];
        $validator=Validator::make($input,$rules,$msg);
        if($validator->fails()){
            return redirect("admin/login")
            ->withErrors($validator)
            ->withInput();
        }
        //验证用户存在
        //保存用户信息到session中
        //跳转到后台首页

    }
}
