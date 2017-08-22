<?php

namespace Dashboard;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    //table name
    protected $table = 'summary';
    public $timestamps = false;
    protected $fillable = ['osar_number','client','project_name','filename','source_files','number_files','number_packages','number_licenses','reportdate','notes'];
    protected $primarykey = 'osar_number';
    protected $dateFormat = 'd.m.Y';
    // each audit climbs many packages in bom
    public function bom() {
        return $this->hasMany('bom');
    }
}
