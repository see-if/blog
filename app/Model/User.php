<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //管理表
    public $table="user";
    //主键
    public $primarykey="id";
    //允许操作的字段
    public $guarded=[];
    //是否维护时间字段
    public $timestamps=false;

}
