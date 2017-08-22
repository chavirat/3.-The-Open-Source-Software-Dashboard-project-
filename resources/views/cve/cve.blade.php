@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">The Common Vulnerabilities and Exposures (CVE) system</h1>
        <p>The Common Vulnerabilities and Exposures (CVE) system provides a reference-method for publicly known information-security vulnerabilities and exposures. The National Cybersecurity FFRDC, operated by the Mitre Corporation, maintains the system, with funding from the National Cyber Security Division of the United States Department of Homeland Security.</p>
    </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-primary">
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-gear fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      @foreach ($most_cve_score as $s)
                      <div class="huge">{{$s->cve_score}}</div>
                      <div>Most Frequent CVE Score</div>
                      @endforeach
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
                      <i class="fa fa-tasks fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    @foreach ($most_cve_severity as $s)
                    <div class="huge">{{$s->severity}}</div>
                    <div>Most Frequent Severity Level of a CVE</div>
                    @endforeach
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
                      <i class="fa fa-flag-o fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge">{{$avg_cve_age}} years</div>
                    <div>Average Age of CVE's</div>
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
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-pie-chart fa-fw"></i> Percentage of Packages with Reported CVE's
        </div>
        <div class="panel-body">
          <div id="total_pkg_cvepie_chart"></div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-table fa-fw"></i> Top 10 Packages with CVE
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <tr>
              <th>Package Name</th>
              <th>CVEs</th>
            </tr>
            @foreach ($top10pkg_cve as $p)
            <tr>
              <td><a href="#" data-toggle="modal" data-target="#{{$p->package_id}}">
                {{$p->package_name}}
              </a></td>
              <td>{{$p->found}}</td>
            </tr>
            <div class="modal fade" id="{{$p->package_id}}" tabindex="-1" role="dialog" aria-labelledby="{{$p->package_id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">{{$p->package_name}}</h5>
                  </div>
                  <div class="modal-body">
                    <p>
                      <b><span class="glyphicon glyphicon-home"></span> </b>
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
<!--pie chart-->
{!!Html::script('js/d3pie.min.js')!!}
<script type="text/javascript">
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var data_total_pkg_cve = <?php echo json_encode($total_pkg_cve) ?>;
    var pkg_cve_pie = new d3pie("total_pkg_cvepie_chart", {
        "size": {
            "canvasHeight": 425,"canvasWidth": 550
        },
        "data": {
            "sortOrder": "value-desc",
            "smallSegmentGrouping": {
              "enabled": true,
              "value": 1
            },
            "content": data_total_pkg_cve
          },
        "labels": {
            "outer": {"pieDistance": 32 },
            "mainLabel": {"fontSize": 12},
            "percentage": {"color": "#ffffff","fontSize": 14,"decimalPlaces": 0}
        },
        "tooltips": {
            "enabled": true,
            "type": "placeholder",
            "string": "{label}: {value}"

        }
    });

  });
</script>
