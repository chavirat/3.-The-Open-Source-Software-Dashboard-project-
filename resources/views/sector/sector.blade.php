@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-lg-12 page-header">
    {!! Form::open([ 'action'=> '{{route('sector')}}','class'=>'form-horizontal','method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
          {{Form::label('sector', 'Sector :',['class'=>'col-md-2 control-label'])}}
          <div class="col-md-3">
            <select class="form-control" name="sector_id" id="sector_id">
              @foreach($sectors as $sector)
                <option value="{{$sector->id}}">{{$sector->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="col-md-1">
        {{Form::submit('Select', ['class'=>'btn btn-primary'])}}
        </div>
        <div class="col-md-1 control-label">
        {{Form::hidden('_method','PUT')}}
        </div>
      </div>
  {!! Form::close() !!}
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
    $('select').on('change',function(){
      sector_id =  $( "select option:selected" ).val();
      });
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
            "canvasHeight": 200,
            "canvasWidth": 250,
            "pieInnerRadius": "70%",
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
});
</script>
