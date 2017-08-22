<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
          <li class="sidebar-search">
              <div class="input-group custom-search-form">
                  <input type="text" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                  <button class="btn btn-default form-control" type="button">
                      <i class="fa fa-search"></i>
                  </button>
              </span>
              </div>
              <!-- /input-group -->
          </li>
          <li>
              <a href="{{route('dashboard')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
          </li>
          <li>
              <a href="{{route('top10')}}"><i class="fa fa-table fa-fw"></i> Top 10</a>
          </li>
          <li>
              <a href="{{route('software_model')}}"><i class="fa fa-pie-chart fa-fw"></i> Software Model</a>
          </li>
          <li>
              <a href="{{route('license_type')}}"><i class="fa fa-pie-chart fa-fw"></i> License Type</a>
          </li>
          <li>
              <a href="{{route('languages')}}"><i class="fa fa-language fa-fw"></i> Languages</a>
          </li>
          <li>
              <a href="#"><i class="fa fa-wrench fa-fw"></i> Vulnerabilities<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                  <li>
                      <a href="{{route('cve')}}">CVE</a>
                  </li>
                  <li>
                      <a href="{{route('severity')}}">Severity</a>
                  </li>
                  <li>
                      <a href="{{route('cvss30calculator')}}">CVSS 3.0 Calculator</a>
                  </li>
                  <li>
                      <a href="{{route('latestcve')}}">Latest CVE Report</a>
                  </li>
              </ul>
          </li>
          <li>
              <a href="/industry/1"><i class="fa fa-industry fa-fw"></i> Industry</a>
          </li>
          <!-- <li>
              <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level collapse">
                  <li>
                      <a href="#">Second Level Item</a>
                  </li>
                  <li>
                      <a href="#">Second Level Item</a>
                  </li>
                  <li>
                      <a href="#">Third Level <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level collapse">
                          <li>
                              <a href="#">Third Level Item</a>
                          </li>
                          <li>
                              <a href="#">Third Level Item</a>
                          </li>
                          <li>
                              <a href="#">Third Level Item</a>
                          </li>
                          <li>
                              <a href="#">Third Level Item</a>
                          </li>
                      </ul>

                  </li>
              </ul>

          </li> -->
      </ul>
  </div>
  <!-- /.sidebar-collapse -->
</div>
