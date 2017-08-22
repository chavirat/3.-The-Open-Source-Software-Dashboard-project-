<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Sectors extends Model
{
  //table name
  protected $table = 'sectors';
  public $timestamps = false;
  protected $fillable = ['id','name','description'];
  protected $primarykey = 'id';
}
