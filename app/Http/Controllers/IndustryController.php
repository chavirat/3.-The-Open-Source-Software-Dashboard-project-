<?php

namespace Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dashboard\Sectors;
class IndustryController extends Controller
{
    public function index()
    {
      //
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($sector_id)
    {
      $sector = Sectors::find($sector_id);
      $total_audit = DB::table('summary')->count('osar_number');
      $top5_licenses_info = DB::table('bom')
      ->join('license','license.license_id','=','bom.license_id')
      ->join('summary','summary.osar_number','=','bom.osar_number')
      ->join('client','client.id','=','summary.client_id')
      ->selectRaw('bom.license_id, license_name, taxonomy, text,count(license_option) as freq, count(distinct bom.osar_number) as occur')
      ->groupBy('bom.license_id','license_name', 'taxonomy', 'text')
      ->where('software_model','=','Open Source')
      ->where('sector_id','=',$sector_id)
      ->orderBy('freq', 'desc')
      ->take(5)
      ->get();
      $top5_packages_info = DB::table('bom')
      ->join('package','package.package_id','=','bom.package_id')
      ->join('summary','summary.osar_number','=','bom.osar_number')
      ->join('client','client.id','=','summary.client_id')
      ->selectRaw('package.package_id,package.package_name,description,homepage_url, count(distinct bom.osar_number) as occur')
      ->groupBy('package.package_id','package.package_name','description','homepage_url')
      ->where('software_model','=','Open Source')
      ->where('sector_id','=',$sector_id)
      ->orderBy('occur', 'desc')
      ->take(5)
      ->get();

      $avg_package = DB::table('summary')
      ->join('client','client.id','=','summary.client_id')
      ->where('sector_id','=',$sector_id)
      ->avg('number_packages');
      $avg_package = round($avg_package);
      $avg_license = DB::table('summary')
      ->join('client','client.id','=','summary.client_id')
      ->where('sector_id','=',$sector_id)
      ->avg('number_licenses');
      $avg_license = round($avg_license);
      $total_cve  = DB::table('summary')
       ->join('bom', 'bom.osar_number', '=', 'summary.osar_number')
       ->join('cve', 'bom.package_id', '=', 'cve.package_id')
       ->join('client','client.id','=','summary.client_id')
       ->where('sector_id','=',$sector_id)
       ->count('cve');
      $avg_cve = round($total_cve/$total_audit) ;
      $avg_values[] = (object)
      array(
      'avg_package'=>$avg_package,
      'avg_license'=>$avg_license,
      'avg_cve'=>$avg_cve
      );
      $no_langs = ['','image','xml','linux','ini','darcs_patch','make','shell'];
      $top5_lang_sector = DB::table('files')
      ->join('summary','summary.osar_number','=','files.osar_number')
      ->join('client','client.id','=','summary.client_id')
      ->selectRaw('language, count(language) as files')
      ->whereNotIn('language', $no_langs)
      ->where('sector_id','=',$sector_id)
      ->groupBy('language')
      ->orderBy('files','desc')
      ->take(5)
      ->get();
      $sectors = Sectors::all();
      $trend_severity_sector = DB::table('cve')
      ->join('bom','bom.package_id','=','cve.package_id')
      ->join('summary','summary.osar_number','=','bom.osar_number')
      ->join('client','client.id','=','summary.client_id')
      ->selectRaw('year(created_at) as year, severity, count(*) as cves')
      ->where('sector_id','=',$sector_id)
      ->groupBy('year','severity')
      ->orderBy('year','asc')
      ->orderBy('severity','asc')
      ->get();
      return view('industry.show',
      compact('sectors','sector','top5_lang_sector','top5_packages_info','top5_licenses_info','total_audit',
      'avg_values','trend_severity_sector'));
    }
    public function edit($sector_id)
    {
        //
    }
    public function update(Request $request, $sector_id)
    {
        //
    }
    public function destroy($sector_id)
    {
        //
    }
}
