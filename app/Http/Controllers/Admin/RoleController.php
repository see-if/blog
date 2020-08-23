<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Role;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data=DB::table("role")
        ->where(function($q)use($request){
            if(!empty($request->name)){
                $q->where("name","like","%".$request->name."%");
            }
        })
        ->paginate(5);
        return view("admin.role.list",compact("data","request"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.role.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取表单提交数据
        $input=$request->except("_token");
        //进行表单验证
        $request->validate([
            'role_name' => 'required',
        ]);
        $arr['name']=$input['role_name'];
        $res=Role::create($arr);
        if($res){
            return redirect("admin/role");
        }else{
            return back()->with('msg','添加失败');
        }
        // dd($input);
    }

    /**
     * Display the specified resource.
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function auth($id){
        $data['id']=$id;
        //获取角色
        $role=Role::find($id);
        // dd($role);
        //获取权限
        $perms=Permission::get();
        //获取当前角色拥有的权限

        $own_perms=$role->permission;
        $own_pers=[];
        foreach($own_perms as $v){
            $own_pers[]=$v->id;
        }
        return view("admin.role.auth",compact("role","perms","own_pers"));
    }
    public function doAuth(Request $request){

        $time=time();
        $input=$request->all();
        // 删除旧的权限
        $res=DB::table("role_permission")->where("role_id",$input['role_id'])->delete();
        //增加新的权限
        if(!empty($input['permission_id'])){
            foreach($input['permission_id'] as $v){
                if($res!==false){
                    $res=DB::insert("insert into blog_role_permission (role_id,permission_id,created_time) values (?,?,?)",[$input['role_id'],$v,$time]);
                }else{
                    break;
                }
            }
        }
        if($res){
            $data['status']=0;
            $data['message']="授权成功";
        }else{
            $data['status']=1;
            $data['message']="授权失败";

        }
        return $data;

    }
}
