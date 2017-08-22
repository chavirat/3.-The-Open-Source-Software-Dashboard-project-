<?php

namespace Dashboard\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dashboard\Http\Controllers\Controller;
use Dashboard\Sectors;
class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function getTop10()
  {
    $total_audit = DB::table('summary')->count('osar_number');
    $top10_licenses_info = DB::table('bom')
    ->join('license','license.license_id','=','bom.license_id')
    ->groupBy('bom.license_id','license_name', 'taxonomy', 'text')
    ->where('software_model','=','Open Source')
    ->selectRaw('bom.license_id, license_name, taxonomy, text,count(license_option) as freq,count(distinct osar_number) as occur')
    ->orderBy('freq', 'desc')
    ->take(10)
    ->get();
    $top10_packages_info = DB::table('bom')
    ->join('package','package.package_id','=','bom.package_id')
    ->groupBy('package.package_id','package.package_name','description','homepage_url')
    ->where('software_model','=','Open Source')
    ->selectRaw('package.package_id,package.package_name,description,homepage_url, count(distinct osar_number) as occur')
    ->orderBy('occur', 'desc')
    ->take(10)
    ->get();
    return view('top10',
    compact('top10_packages_info','top10_licenses_info','total_audit'));
  }
  public function getSoftwareModel(){
    $software_model_files = DB::table('bom')
    ->groupBy('software_model')
    ->selectRaw('software_model , sum(files) as files')
    ->get();
    $avg_software_model_files = DB::table('per_files_sm')
    ->selectRaw('software_model, avg(per_total) as perfiles')
    ->groupBy('software_model')
    ->get();
    return view('software_model',
    compact('software_model_files','avg_software_model_files'));
  }
  public function getLicenseType(){
    $license_type_files = DB::table('bom')
    ->groupBy('license_type')
    ->selectRaw('license_type , sum(files) as files')
    ->get();
    $avg_license_type_files = DB::table('per_files_lt')
    ->selectRaw('license_type, avg(per_total) as perfiles')
    ->groupBy('license_type')
    ->get();
    return view('license_type',
    compact('license_type_files','avg_license_type_files'));
  }
  public function getSummary()
    {
      $total_audit = DB::table('summary')->count('osar_number');
      $software_model_files = DB::table('bom')
      ->groupBy('software_model')
      ->selectRaw('software_model , sum(files) as files')
      ->get();
      $license_type_files = DB::table('bom')
      ->groupBy('license_type')
      ->selectRaw('license_type , sum(files) as files')
      ->get();
      $avg_package = DB::table('summary')->avg('number_packages');
      $avg_package = round($avg_package);
      $avg_license = DB::table('summary')->avg('number_licenses');
      $avg_license = round($avg_license);
      $total_cve  = DB::table('summary')
       ->join('bom', 'bom.osar_number', '=', 'summary.osar_number')
       ->join('cve', 'bom.package_id', '=', 'cve.package_id')
       ->count('cve');
      $avg_cve = round($total_cve/$total_audit) ;
      $avg_values[] = (object)
      array(
      'avg_package'=>$avg_package,
      'avg_license'=>$avg_license,
      'avg_cve'=>$avg_cve
      );

      $audit_w_oss = DB::table('bom')
      ->where('software_model','=','Open Source')
      ->distinct('osar_number')
      ->count('osar_number');
      $audit_wo_oss = $total_audit - $audit_w_oss;
       $per_audit_w_oss = ($audit_w_oss/$total_audit)*100;
      // $total_auditpie=[];
      // $array_audit = array('label'=>'Audits with OSS','value'=>$audit_w_oss);
      // $array_auditwo = array('label'=>'Audits without OSS','value' =>$audit_wo_oss);
      // array_push($total_auditpie,$array_audit);
      // array_push($total_auditpie,$array_auditwo);
        $total_files = DB::table('summary')->sum('number_files');
      //  $files_w_oss = DB::table('bom')
      //  ->where('software_model','=','Open Source')
      //  ->sum('files');
      //  $files_w_oss = (int)$files_w_oss;
      //  $files_wo_oss = $total_files - $files_w_oss;
      //  $total_filespie=[];
      //  $array_files = array('label'=>'Files with OSS','value'=>$files_w_oss);
      //  $array_fileswo = array('label'=>'Files without OSS','value' =>$files_wo_oss);
      //  array_push($total_filespie,$array_files);
      //  array_push($total_filespie,$array_fileswo);
       $top5permissive_files = DB::table('bom')
       ->join('license', 'bom.license_id', '=', 'license.license_id')
       ->selectRaw('license_base, sum(files) as files')
       ->where('license_type','=','Permissive')
       ->groupBy('license_base')
       ->orderBy('files','desc')
       ->take(5)
       ->get();
       $top3copyleftweak_files = DB::table('bom')
       ->join('license', 'bom.license_id', '=', 'license.license_id')
       ->selectRaw('license_base, sum(files) as files')
       ->where('license_type','=','Copyleft Weak')
       ->groupBy('license_base')
       ->orderBy('files','desc')
       ->take(3)
       ->get();
       $top2copyleft_files = DB::table('bom')
       ->join('license', 'bom.license_id', '=', 'license.license_id')
       ->selectRaw('license_base, sum(files) as files')
       ->where('license_type','=','Copyleft')
       ->groupBy('license_base')
       ->orderBy('files','desc')
       ->take(2)
       ->get();

       $audit_freeware = DB::table('bom')
       ->where('software_model','=','Freeware')
       ->distinct('osar_number')
       ->count('osar_number');
       $per_audit_freeware = ($audit_freeware/$total_audit)*100;
       $per_audit_freeware =  number_format($per_audit_freeware);
       $audit_copyleft = DB::table('bom')
       ->where('license_type','=','Copyleft')
       ->distinct('osar_number')
       ->count('osar_number');
       $per_audit_copyleft = ($audit_copyleft/$total_audit)*100;
       $per_audit_copyleft = number_format($per_audit_copyleft);

       $package_list = ['Unidentified Package','00-Needs Client Review'];
       $audit_commercial = DB::table('bom')
       ->whereIn('identified_package', $package_list)
       ->distinct('osar_number')
       ->count('osar_number');
       $per_audit_commercial = ($audit_commercial/$total_audit)*100;
       $per_audit_commercial = number_format($per_audit_commercial);
      //  $sectors = Sectors::all();
    return view('dashboard',
    compact('avg_values','software_model_files','license_type_files',
    'per_audit_w_oss','per_audit_freeware','per_audit_copyleft','per_audit_commercial',
    'total_files','top5permissive_files','top3copyleftweak_files','top2copyleft_files'));
     }
     public function getLanguages(){
       $no_langs = ['','image','xml','linux','ini','darcs_patch','make','shell'];
       $top5_lang = DB::table('files')
       ->selectRaw('language, count(language) as files')
       ->whereNotIn('language', $no_langs)
       ->groupBy('language')
       ->orderBy('files','desc')
       ->take(5)
       ->get();
       $lang_files = DB::table('files')
       ->selectRaw('language, count(language) as files')
       ->whereNotIn('language', $no_langs)
       ->groupBy('language')
       ->orderBy('files','desc')
       ->get();
       $avg_lang_files = DB::table('per_files_lang')
       ->selectRaw('language, avg(count) as perfiles')
       ->groupBy('language')
       ->orderBy('perfiles','desc')
       ->get();

       $trend_lang = DB::table('lang_audit')
       ->join('files', 'files.language', '=', 'lang_audit.language')
       ->join('summary', 'summary.osar_number', '=', 'files.osar_number')
       ->selectRaw('year(reportdate) as year, lang_audit.language, count(*) as files')
       ->groupBy('year','language')
       ->orderBy('year','asc')
       ->orderBy('files','desc')
       ->get();
       return view('languages',
       compact('top5_lang','lang_files','avg_lang_files','trend_lang'));
     }
}
