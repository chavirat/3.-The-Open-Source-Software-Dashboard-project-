<?php

namespace Dashboard\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dashboard\Http\Controllers\Controller;

class CveController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function getCVE(){
    $most_cve_score = DB::table('cve')
    ->groupBy('cve_score')
    ->selectRaw('cve_score, count(cve_score) as found')
    ->orderBy('found', 'desc')
    ->take(1)
    ->get();

    $most_cve_severity = DB::table('cve')
    ->groupBy('severity')
    ->selectRaw('severity, count(severity) as found')
    ->orderBy('found', 'desc')
    ->take(1)
    ->get();

    $avg_cve_age = DB::table('summary')
    ->join('bom', 'bom.osar_number', '=', 'summary.osar_number')
    ->join('cve', 'bom.package_id', '=', 'cve.package_id')
    ->selectRaw('avg(year(reportdate) - year(created_at)) as avg_age')
    ->get();
    foreach($avg_cve_age as $k => $cur)
       {
         $avg_age =  $cur->avg_age;
       }
    $avg_cve_age = number_format($avg_age, 2);

    $pkg_w_cve = DB::table('bom')
    ->join('cve', 'bom.package_id', '=', 'cve.package_id')
    ->distinct('bom.package_id')
    ->count('bom.package_id');
    $total_pkg = DB::table('bom')->count('package_id');
    $pkg_wo_cve = $total_pkg - $pkg_w_cve;
    $total_pkg_cve = [];
    $array_pkg_cve = array("label"=>"Packages with reported CVE's","value"=>$pkg_w_cve);
    $array_pkg_wo_cve = array("label"=>"Packages without reported CVE's","value"=>$pkg_wo_cve);
    array_push($total_pkg_cve,$array_pkg_cve);
    array_push($total_pkg_cve,$array_pkg_wo_cve);

    $top10pkg_cve = DB::table('package')
    ->join('bom', 'package.package_id', '=', 'bom.package_id')
    ->join('cve','bom.package_id','=','cve.package_id')
    ->groupBy('package.package_id','package.package_name','homepage_url','description')
    ->selectRaw('package.package_id, package.package_name, homepage_url, description, count(bom.package_id) as found')
    ->orderBy('found', 'desc')
    ->take(10)
    ->get();
    return view('cve.cve',
    compact('most_cve_score','most_cve_severity','avg_cve_age','total_pkg_cve','top10pkg_cve'));
  }
  public function getcvss30calculator(){
    return view('cve.cvss_30_calculator');
  }
  public function getLatestCve(){
    return view('cve.latestcve');
  }
  public function getSeverity(){
    $trend_severity = DB::table('cve')
    ->selectRaw('year(created_at) as year, severity, count(*) as cves')
    ->groupBy('year','severity')
    ->orderBy('year','asc')
    ->orderBy('severity','asc')
    ->get();

    $top10pkg_highcve = DB::table('package')
    ->join('bom', 'package.package_id', '=', 'bom.package_id')
    ->join('cve','bom.package_id','=','cve.package_id')
    ->groupBy('package.package_id','package.package_name','homepage_url','description')
    ->selectRaw('package.package_id, package.package_name, homepage_url, description, count(bom.package_id) as found')
    ->where('cve_score','>',7)
    ->orderBy('found', 'desc')
    ->take(10)
    ->get();

    return view('cve.severity',compact('trend_severity','top10pkg_highcve'));
  }
}
