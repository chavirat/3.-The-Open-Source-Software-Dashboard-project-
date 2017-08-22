@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">open source software dashboard</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-3 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-cubes fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{{ $per_audit_w_oss}} %</div>
                      <div>Open Source Software</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="panel panel-red">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-bullhorn fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{ $per_audit_copyleft }} %</div>
                    <div>Copyleft Licenses</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="panel panel-yellow">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-legal fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{ $per_audit_freeware }} %</div>
                    <div>Non Commercial License</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  <div class="col-lg-3 col-md-6">
      <div class="panel panel-primary">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-shopping-cart fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{ $per_audit_commercial}} %</div>
                    <div>Commercial Components</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  </div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> Sankey Chart
      </div>
      <div class="panel-body">
        <div id="sankey_chart"></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  @foreach ($avg_values as $a)
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-primary">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-dropbox fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge">{{$a->avg_package}}</div>
                      <div>Average Number of OSS Packages</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-green">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-legal fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{$a->avg_license}}</div>
                    <div>Average Number of OSS Licenses</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-yellow">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-asterisk fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{$a->avg_cve}}</div>
                    <div>Average Number of CVE's Identified</div>
                  </div>
              </div>
          </div>
          <a href="#">
              <div class="panel-footer">
                  <span class="pull-left">View Details</span>
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
  </div>
   @endforeach
  </div>

@endsection
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<!--d3 -->
{!!Html::script('js/d3.v3.min.js')!!}
<!--sankey chart-->
{!!Html::script('js/d3.chart.min.js')!!}
{!!Html::script('js/d3.chart.sankey.min.js')!!}


<script type="text/javascript">
  $(document).ready(function() {
//sankey chart
var total_files = <?php echo json_encode($total_files) ?>;
var software_model_files = <?php echo json_encode($software_model_files) ?>;
var license_type_files = <?php echo json_encode($license_type_files) ?>;
var top5permissive_files = <?php echo json_encode($top5permissive_files) ?>;
var top3copyleftweak_files = <?php echo json_encode($top3copyleftweak_files) ?>;
var top2copyleft_files = <?php echo json_encode($top2copyleft_files) ?>;
var data_sankey = create_json(total_files, software_model_files,license_type_files,
top5permissive_files,top3copyleftweak_files,top2copyleft_files);
create_sankey(JSON.parse(data_sankey));
});
</script>
