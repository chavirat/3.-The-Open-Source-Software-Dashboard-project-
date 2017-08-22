@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Top 10 Open Source Software</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-table fa-fw"></i> Top 10 OSS packages
      </div>
      <div class="panel-body">
      <div id = "top10_packages_table"></div>
    </div>
  </div>
 </div>
 <div class="col-lg-6">
   <div class="panel panel-default">
     <div class="panel-heading">
       <i class="fa fa-table fa-fw"></i> Top 10 OSS licenses
     </div>
     <div class="panel-body">
     <div id = "top10_licenses_table"></div>
   </div>
 </div>
</div>
</div>
@endsection
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<script type="text/javascript">
$(document).ready(function() {
  var top10_licenses_info = <?php echo $top10_licenses_info ?>;
  var top10_packages_info = <?php echo $top10_packages_info ?>;
  var total_audit = <?php echo $total_audit ?>;
  jsonToTableLicense(top10_licenses_info,total_audit,"top10_licenses_table");
  jsonToTablePackage(top10_packages_info,total_audit,"top10_packages_table");
});
</script>
