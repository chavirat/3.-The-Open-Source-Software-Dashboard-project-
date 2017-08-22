@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">NVD Vulnerability Severity Ratings</h1>
        <p>NVD provides severity rankings of "Low," "Medium," and "High" in addition to the numeric CVSS scores
but these qualitative rankings are simply mapped from the numeric CVSS scores:</p>
        <dl>
          <li>Vulnerabilities are labeled "Low" severity if they have a CVSS base score of 0.0-3.9.</li>
          <li>Vulnerabilities will be labeled "Medium" severity if they have a base CVSS score of 4.0-6.9.</li>
          <li>Vulnerabilities will be labeled "High" severity if they have a CVSS base score of 7.0-10.0.</li>
      </dl>
    </div>
</div>
<div class="row">
  <div class="col-lg-9">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-bar-chart-o fa-fw"></i> trend of severity level
      </div>
      <div class="panel-body">
        <div id="viz" style="height:400px;"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-table fa-fw"></i> Top 10 Packages with high Severity
      </div>
      <div class="panel-body">
        <table class="table table-striped">
          {{-- <tr>
            <th>Package Name</th>
            <th>CVEs</th>
          </tr> --}}
          @foreach ($top10pkg_highcve as $index=>$p)
          <tr>
            <td>{{++ $index}}</td>
            <td class="text-cap"><a href="#" data-toggle="modal" data-target="#{{$p->package_id}}">
              {{$p->package_name}}
            </a></td>
            {{-- <td>{{$p->found}}</td> --}}
          </tr>
          <div class="modal fade" id="{{$p->package_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$p->package_id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">{{$p->package_name}}</h5>
                </div>
                <div class="modal-body">
                  <p>
                    <b><i class="fa fa-home fa-fw"></i> </b>
                    <a href="{{$p->homepage_url}}" target="_blank">{{$p->homepage_url}}</a>
                  </p>
                  <div class="alert alert-info">{!! $p->description !!}</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<!--d3 -->
{!!Html::script('js/d3.v3.min.js')!!}
<!--d3plus-->
{!!Html::script('js/d3plus.full.min.js')!!}
<script type="text/javascript">
$(document).ready(function() {
  var trend_severity = <?php echo json_encode($trend_severity) ?>;
  var attributes =[
    {  "severity":"HIGH",  "color":"#396779"},
    {  "severity":"MEDIUM",  "color":"#5293AD"},
    {  "severity":"LOW",  "color":"#86B3C6"}];
  var visualization = d3plus.viz()
      .container("#viz")
      .data(trend_severity)
      .type("bar")
      .id("severity")
      .x("year")
      .y({"stacked": true, "value": "cves"})
      .attrs(attributes)
      .color("color")
      .draw();
});
</script>
