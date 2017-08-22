<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
  //table name
  protected $table = 'bom';
  public $timestamps = false;

  protected $fillable = ['osar_number','package_id','license_id','identified_package','files','identified_licenses','license_option','license_type','notes','software_model','package_home'];
  protected $primarykey = 'id';
  // each package in bom has many cves
  public function cve() {
      return $this->hasMany('cve');
  }
  public function summary() {
      return $this->belongsTo('summary');
   }
  public function package() {
      return $this->hasOne('bom');
    }
  public function license() {
      return $this->hasOne('bom');
   }
}
