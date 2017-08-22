<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Cve extends Model
{
  //table name
  protected $table = 'cve';
  public $timestamps = false;
  protected $fillable = ['package_id','package_name','multi_packages','versions','cve','cve_score','severity','access_complexity','updated_at','nvd_link','created_at','summary','access_vector','integrity_impact'];
  protected $primarykey = 'cve';
  // each package in bom has many cves
  public function bom_package() {
       return $this->belongsTo('bom');
   }
}
