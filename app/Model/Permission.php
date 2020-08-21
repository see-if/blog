<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     //管理表
     protected $table ="permission";
     //主键
     protected $primaryKey ="id";
     //允许操作的字段
     public $guarded=[];
     //是否维护时间字段
     public $timestamps = false;
}
