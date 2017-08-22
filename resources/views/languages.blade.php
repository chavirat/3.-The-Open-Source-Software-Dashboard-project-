@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Languages  (all applications scanned)</h1>
    </div>
</div>
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> Trend of Top 5 Languages
      </div>
      <div class="panel-body">
        <div id="viz" style="height:400px;"></div>
      </div>
    </div>
  </div>
<div class="col-md-3">
  <div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-table fa-fw"></i> Top 5 Languages
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        @foreach ($top5_lang as $index=>$t)
        <tr>
          <td>{{++ $index}}</td>
          <td class="text-cap">
            {{$t->language}}
          </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>

</div>
<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <i class="fa fa-pie-chart fa-fw"></i> Percentage of total files by languages
      </div>
      <div class="panel-body">
        <div id="lang_filespie_chart"></div>
        <div id="lang_file_legend"></div>
    </div>
  </div>
 </div>
 <div class="col-lg-6">
   <div class="panel panel-default">
     <div class="panel-heading">
       <i class="fa fa-pie-chart fa-fw"></i> Average percentage of files by languages
     </div>
     <div class="panel-body">
       <div id="avg_lang_filespie_chart"></div>
       <div id="avg_lang_file_legend"></div>
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
//color of files by software model
var color_sf = ['#424094', '#D14524', '#5293AD', '#943235', '#F4A416', '#2D9F5F', '#5A3386'];
// blue, orange,light blue, red,yellow, green, purple
var lang_files = <?php echo json_encode($lang_files) ?>;
var top5_lang = <?php echo json_encode($top5_lang) ?>;
var data_lang_filespie =[];
$.map(lang_files, function(obj, i) {
    return [
        [data_lang_filespie.push({
            label: obj.language,
            value: obj.files,
            color: color_sf[i]
        })]
    ];
})
var avg_lang_files = <?php echo json_encode($avg_lang_files) ?>;
var data_avg_lang_filespie =[];
$.map(avg_lang_files, function(obj, i) {
    return [
        [data_avg_lang_filespie.push({
            label: obj.language,
            value: parseFloat(obj.perfiles),
            color: color_sf[i]
        })]
    ];
})

var lang_sum_filespie = new d3pie("lang_filespie_chart", {
    "size": {
        "canvasHeight": 400,"canvasWidth": 550
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
          "enabled": true,
          "value": 1
        },
        "content": data_lang_filespie
      },

    "labels": {
        "outer": {"pieDistance": 32 },
        "inner": {"hideWhenLessThanPercentage": 5},
        "mainLabel": {"fontSize": 12},
        "percentage": {"color": "#ffffff","fontSize": 14,"decimalPlaces": 0}
    },
    "tooltips": {
        "enabled": true,"type": "placeholder","string": "{label}: {value}"
    }
});
// var lang_file_legend = create_legend(data_lang_filespie, color_sf);
// $( "#lang_file_legend" ).append( lang_file_legend );
var avg_lang_sum_filespie = new d3pie("avg_lang_filespie_chart", {
    "size": {
        "canvasHeight": 400,"canvasWidth": 550
    },
    "data": {
        "sortOrder": "value-desc",
        "smallSegmentGrouping": {
          "enabled": true,
          "value": 1
        },
        "content": data_avg_lang_filespie
      },

    "labels": {
        "outer": {"pieDistance": 32 },
        "inner": {"hideWhenLessThanPercentage": 5},
        "mainLabel": {"fontSize": 12},
        "percentage": {"color": "#ffffff","fontSize": 14,"decimalPlaces": 0}
    },
    "tooltips": {
        "enabled": true,"type": "placeholder","string": "{label}: {value}%"
    }
});
// var avg_lang_file_legend = create_legend(data_avg_lang_filespie, color_sf);
// $( "#avg_lang_file_legend" ).append( avg_lang_file_legend );
var trend_lang = <?php echo json_encode($trend_lang) ?>;
var attributes =[];
$.map(top5_lang, function(obj, i) {
    return [
        [attributes.push({
            language: obj.language,
            color: color_sf[i]
        })]
    ];
})
//console.log(attributes);
var visualization = d3plus.viz()
    .container("#viz") // container DIV to hold the visualization
    .data(trend_lang) // data to use with the visualization
    .type("bar") // visualization type
    .id("language") // key for which our data is unique on
    .x("year")
    .y({"stacked": true, "value": "files"})
    .attrs(attributes)
    .color("color")
    .draw(); // finally, draw the visualization!
});

</script>
