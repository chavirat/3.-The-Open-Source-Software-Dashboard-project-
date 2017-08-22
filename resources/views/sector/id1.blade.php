<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
          <i class="fa fa-task-o fa-fw"></i> introduction
      </div>
      <div class="panel-body">
        <p id="description"></p>
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
        <div id="trend_severity"></div>
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
