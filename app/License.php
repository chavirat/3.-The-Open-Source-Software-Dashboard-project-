<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
  //table name
  protected $table = 'license';
  public $timestamps = false;
  protected $fillable = ['license_id','license_name','taxonomy','text','license_notes'];
  protected $primarykey = 'license_id';

}
