<?php

namespace Dashboard;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'active','role_id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function role()
    {
      return $this->hasOne('Dashboard\Role','id','role_id');
    }
    private function checkIfUserHasRole($need_role)
    {
      return (strtolower($need_role)==strtolower($this->role->name)) ? true : null;
    }
    public function hasRole($role)
    {
      if(is_array($role))
      {
        foreach ($role as $need_role) {
          if($this->checkIfUserHasRole($need_role))
          {
            return true;
          }
        }
      }else{
        return $this->checkIfUserHasRole($role);
      }
      return false;
    }
}
