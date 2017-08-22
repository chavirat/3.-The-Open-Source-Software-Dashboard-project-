@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Software License Types  (all applications scanned)</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-pie-chart fa-fw"></i> Percentage of total files by license type
      </div>
      <div class="panel-body">
        <div id ="license_type_filespie_chart"></div>
        <div id="license_type_file_legend"></div>
    </div>
  </div>
 </div>
 <div class="col-lg-6">
   <div class="panel panel-default">
     <div class="panel-heading">
       <i class="fa fa-pie-chart fa-fw"></i> Average of percentage of files by license type
     </div>
     <div class="panel-body">
       <div id="avg_license_type_filespie_chart"></div>
       <div id="avg_license_type_file_legend"></div>
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
<script type="text/javascript">
$(document).ready(function() {
var color_bl = ['#C0C0C0','#943235', '#F4A416', '#2D9F5F', '#5A3386', '#424094', '#D14524', '#5293AD']; // grey,red, yellow, green, purple,blue, orange,light blue
var license_type_files = <?php echo json_encode($license_type_files) ?>;
var data_license_type_filespie =[];
$.map(license_type_files, function(obj, i) {
    return [
        [data_license_type_filespie.push({
            label: obj.license_type,
            value: parseFloat(obj.files),
            color: color_bl[i]
        })]
    ];
})
var avg_license_type_files = <?php echo json_encode($avg_license_type_files) ?>;
var data_avg_license_type_filespie =[];
$.map(avg_license_type_files, function(obj, i) {
    return [
        [data_avg_license_type_filespie.push({
            label: obj.license_type,
            value: parseFloat(obj.perfiles),
            color: color_bl[i]
        })]
    ];
})
var license_type_sum_filespie = new d3pie("license_type_filespie_chart", {
    "size": {
        "canvasHeight": 400,"canvasWidth": 550
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
          "enabled": true,
          "value": 1
        },
        "content": data_license_type_filespie
      },

    "labels": {
        "outer": {"pieDistance": 32 },
        "inner": {"hideWhenLessThanPercentage": 3},
        "mainLabel": {"fontSize": 12},
        "percentage": {"color": "#ffffff","fontSize": 14,"decimalPlaces": 0}
    },
    "tooltips": {
        "enabled": true,"type": "placeholder","string": "{label}: {value}"
    }
});
var license_type_file_legend = create_legend(data_license_type_filespie, color_bl);
$( "#license_type_file_legend" ).append( license_type_file_legend );
var avg_license_type_sum_filespie = new d3pie("avg_license_type_filespie_chart", {
    "size": {
        "canvasHeight": 400,"canvasWidth": 550
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
          "enabled": true,
          "value": 1
        },
        "content": data_avg_license_type_filespie
      },

    "labels": {
        "outer": {"pieDistance": 32 },
        "inner": {"hideWhenLessThanPercentage": 3},
        "mainLabel": {"fontSize": 12},
        "percentage": {"color": "#ffffff","fontSize": 14,"decimalPlaces": 0}
    },
    "tooltips": {
        "enabled": true,"type": "placeholder","string": "{label}: {value}%"
    }
});
var avg_license_type_file_legend = create_legend(data_avg_license_type_filespie, color_bl);
$( "#avg_license_type_file_legend" ).append( avg_license_type_file_legend );

});
</script>
