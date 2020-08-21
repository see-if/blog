<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     //管理表
     protected $table ="role";
     //主键
     protected $primaryKey ="id";
     //允许操作的字段
     public $guarded=[];
     //是否维护时间字段
     public $timestamps = false;
     //关联模型
     public function permission(){
          return $this->belongsToMany("APP\Model\Permission","role_permission","role_id","permission_id");
     }
}
