<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
  //table name
  protected $table = 'package';
  public $timestamps = false;
  protected $fillable = ['package_id','package_name','languages','homepage_url','description'];
  protected $primarykey = 'package_id';

}
