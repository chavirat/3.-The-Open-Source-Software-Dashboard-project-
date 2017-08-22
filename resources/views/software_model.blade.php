@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Software Model  (all applications scanned)</h1>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-pie-chart fa-fw"></i> Percentage of total files by software model
      </div>
      <div class="panel-body">
        <div id="software_model_filespie_chart"></div>
        <div id="software_model_file_legend"></div>
    </div>
  </div>
 </div>
 <div class="col-lg-6">
   <div class="panel panel-default">
     <div class="panel-heading">
       <i class="fa fa-pie-chart fa-fw"></i> Average percentage of files by software model
     </div>
     <div class="panel-body">
       <div id="avg_software_model_filespie_chart"></div>
       <div id="avg_software_model_file_legend"></div>
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
    //color of files by software model
    var color_sf = ['#C0C0C0','#424094', '#D14524', '#5293AD', '#943235', '#F4A416', '#2D9F5F', '#5A3386'];
    // grey,blue, orange,light blue, red,yellow, green, purple
    var software_model_files = <?php echo json_encode($software_model_files) ?>;
    var data_software_model_filespie =[];
    $.map(software_model_files, function(obj, i) {
        return [
            [data_software_model_filespie.push({
                label: obj.software_model,
                value: parseFloat(obj.files),
                color: color_sf[i]
            })]
        ];
    })
    var avg_software_model_files = <?php echo json_encode($avg_software_model_files) ?>;
    var data_avg_software_model_filespie =[];
    $.map(avg_software_model_files, function(obj, i) {
        return [
            [data_avg_software_model_filespie.push({
                label: obj.software_model,
                value: parseFloat(obj.perfiles),
                color: color_sf[i]
            })]
        ];
    })
    var software_model_sum_filespie = new d3pie("software_model_filespie_chart", {
        "size": {
            "canvasHeight": 400,"canvasWidth": 550
        },
        "data": {
            "sortOrder": "value-desc",
            "smallSegmentGrouping": {
              "enabled": true,
              "value": 1
            },
            "content": data_software_model_filespie
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
    var software_model_file_legend = create_legend(data_software_model_filespie, color_sf);
    $( "#software_model_file_legend" ).append( software_model_file_legend );
    var avg_software_model_sum_filespie = new d3pie("avg_software_model_filespie_chart", {
        "size": {
            "canvasHeight": 400,"canvasWidth": 550
        },
        "data": {
            "sortOrder": "value-desc",
            "smallSegmentGrouping": {
              "enabled": true,
              "value": 1
            },
            "content": data_avg_software_model_filespie
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
    var avg_software_model_file_legend = create_legend(data_avg_software_model_filespie, color_sf);
    $( "#avg_software_model_file_legend" ).append( avg_software_model_file_legend );

});
</script>
