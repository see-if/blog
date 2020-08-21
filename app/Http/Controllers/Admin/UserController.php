<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\User;
use DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 获取列表页
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $input=$request->except("_token");
        // dd($input);
        $page_size=intval($request->page_size)?intval($request->page_size):3;
        $data=DB::table("user")
        ->where(function($q)use($request){
            if(!empty($request->username)){
                $q->where("user_name","like","%".$request->username."%");
            }
        })
        ->orderBy('id','desc')
        ->paginate($page_size);

        return view("admin.user.list",compact("data","page_size","request"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * 返回用户添加页面
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin/user/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * 执行用户的添加操作
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB::table("user")->insert(['email'=>"123456"]);
        // return 123456;
        //1.接受前端提交的数据
        $input=$request->all();
        
        //2.进行表单验证
        //3.添加到数据库的user表
        $data['user_name']=$input['username'];
        $data['user_pass']=$input['pass'];
        $data['email']=$input['email'];
        $res=DB::table("user")->insert($data);
        //4。根据是否添加成功，给客户端返回一个json格式的反馈
        if($res){
            $root['status']=0;
            $root['message']="添加成功";
        }else{
            $root['status']=1;
            $root['message']="添加失败";

        }
        return $root;
    }

    /**
     * Display the specified resource.
     *
     * 显示一条数据
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *返回一个修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=DB::table("user")->where("id",$id)->first();
        return view("admin.user.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *执行修改操作
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Validator::make($request->all(), [
            'email' => 'required|email',
            'username' => 'required',
        ])->validate();
        $user_name=$request->username;
        $email=$request->email;
        $res = DB::update('update blog_user set user_name="'.$user_name.'",email = "'.$email.'" where id = ?', [$id]);
        if($res){
            $root['status']=0;
            $root['message']="添加成功";
        }else{
            $root['status']=1;
            $root['message']="添加失败";

        }
        return $root;
    }

    /**
     * Remove the specified resource from storage.
     *执行删除操作
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(empty($id)){
            return false;
        }
        $res=DB::delete("delete from blog_user where id = ? ",[$id]);
        if($res){
            $data['status']=0;
            $data['message']="添加成功";
        }else{
            $data['status']=1;
            $data['message']="添加失败";

        }
        return $data;
    }
    public function delAll(Request $request){
        $ids=$request->input('ids');
        $str=rtrim(str_pad('', 2 * count($ids), '?,',STR_PAD_RIGHT) , ',');
        $res=DB::delete("delete from  blog_user where id in  (".$str.")   ",$ids);

        if($res){
            $data['status']=0;
            $data['message']="删除成功";
        }else{
            $data['status']=1;
            $data['message']="删除失败";

        }
        return $data;
    }
    public function incr(){
        $has=Hash::make(123456);
        $res=User::create(['user_name'=>'testincr','user_pass'=>$has,'status'=>1]);
        dd($res);
    }
}
