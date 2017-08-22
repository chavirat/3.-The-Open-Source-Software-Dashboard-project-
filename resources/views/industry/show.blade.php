@extends('layouts.master')
@section('content')
  <div class="row">
    <div class="col-lg-12 page-header">
      <h1>{{$sector->name}}</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      {!! Form::open(['class'=>'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('sector', 'Select a New Sector :',['class'=>'col-md-9 control-label'])}}
            <div class="col-md-3">
              <select id="sector_id" class="form-control" onchange="window.location.href = this.value" name="select">
                @foreach($sectors as $s)
                  <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
              </select>
          </div>
        </div>
    {!! Form::close() !!}
    </div>
  </div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-align-justify fa-fw"></i> description
      </div>
      <div class="panel-body">
        <p id="description">{{$sector->description}}</p>
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

<div class="row">
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-piechart fa-fw"></i> Top 5 Languages
      </div>
      <div class="panel-body">
        <div id="top5_lang_sectorpie_chart"></div>
        <div id="top5_lang_sector_legend"></div>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> Trend of Severity Level
      </div>
      <div class="panel-body">
          <div id="viz" style="height:280px;"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-table fa-fw"></i> Top 5 OSS packages
      </div>
      <div class="panel-body">
      <div id = "top5_packages_table"></div>
    </div>
  </div>
 </div>
 <div class="col-lg-6">
   <div class="panel panel-default">
     <div class="panel-heading">
       <i class="fa fa-table fa-fw"></i> Top 5 OSS licenses
     </div>
     <div class="panel-body">
     <div id = "top5_licenses_table"></div>
   </div>
 </div>
</div>
</div>
@endsection
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<!--d3 -->
{!!Html::script('js/d3.v3.min.js')!!}
<!--pie chart-->
{!!Html::script('js/d3pie.min.js')!!}
<!--d3plus-->
{!!Html::script('js/d3plus.full.min.js')!!}
<script type="text/javascript">
  $(document).ready(function() {

    var top5_licenses_info = <?php echo $top5_licenses_info ?>;
    var top5_packages_info = <?php echo $top5_packages_info ?>;
    var total_audit = <?php echo $total_audit ?>;
    jsonToTableLicense(top5_licenses_info,total_audit,"top5_licenses_table");
    jsonToTablePackage(top5_packages_info,total_audit,"top5_packages_table");
    //color of files by software model
    var color_sf = ['#424094', '#D14524', '#5293AD', '#943235', '#F4A416', '#2D9F5F', '#5A3386'];
    // blue, orange,light blue, red,yellow, green, purple
    var top5_lang_sector = <?php echo json_encode($top5_lang_sector) ?>;
    var data_top5_lang_sectorpie =[];
    $.map(top5_lang_sector, function(obj, i) {
        return [
            [data_top5_lang_sectorpie.push({
                label: obj.language,
                value: parseFloat(obj.files),
                color: color_sf[i]
            })]
        ];
    })
    var top5_lang_sectorpie = new d3pie("top5_lang_sectorpie_chart", {
        "size": {
            "canvasHeight": 250,
            "canvasWidth": 250,
            "pieInnerRadius": "60%",
        },
        "data": {
            "sortOrder": "value-desc",
            "smallSegmentGrouping": {
              "enabled": true,
              "value": 1
            },
            "content": data_top5_lang_sectorpie
          },

        "labels": {
            "outer": { "pieDistance": 10 },
            "inner": {"hideWhenLessThanPercentage": 3},
            "mainLabel": {"fontSize": 10},
            "percentage": {"color": "#ffffff","fontSize": 11,"decimalPlaces": 0}
        },
        "tooltips": {
            "enabled": true,"type": "placeholder","string": "{label}: {value}"
        }
    });
    var top5_lang_sector_legend = create_legend(data_top5_lang_sectorpie, color_sf);
    $( "#top5_lang_sector_legend" ).append( top5_lang_sector_legend );

    var trend_severity_sector = <?php echo json_encode($trend_severity_sector) ?>;
    var attributes =[
      {  "severity":"HIGH",  "color":"#396779"},
      {  "severity":"MEDIUM",  "color":"#5293AD"},
      {  "severity":"LOW",  "color":"#86B3C6"}];
    var visualization = d3plus.viz()
        .container("#viz")
        .data(trend_severity_sector)
        .type("bar")
        .id("severity")
        .x("year")
        .y({"stacked": true, "value": "cves"})
        .attrs(attributes)
        .color("color")
        .draw();
});
</script>
