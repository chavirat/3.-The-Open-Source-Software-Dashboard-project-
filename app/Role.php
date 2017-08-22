<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function users()
    {
      return $this->hasMany('Dashboard\User','role_id','id');
    }
}
