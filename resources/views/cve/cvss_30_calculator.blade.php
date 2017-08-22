<!--cvss css-->
{!!Html::style ('css/cvss.css')!!}
@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Common Vulnerability Scoring System Version 3.0 Calculator</h1>

            <div class="panel panel-default">
              <div class="panel-heading">
                <a data-parent="#accordion" data-toggle="collapse" href="#obID1" role="button" aria-expanded="true">
                  <i class="fa fa-bars fa-fw"></i> Introduction
                  </a>
              </div>
              <div class="panel-collapse aria-labelledby= collapse in" id="obID1" role="tabpanel" aria-expanded="true">
              <div class="panel-body">
                <p>This guide supplements the formal CVSS v3.0 specification document by providing additional information,
                  highlighting relevant changes from v2.0, as well as providing scoring guidance and a scoring rubric.</p>
                <p>The Common Vulnerability Scoring System (CVSS) provides a way to capture the principal characteristics of a vulnerability,
                  and produce a numerical score reflecting its severity, as well as a textual representation of that score.
                  The numerical score can then be translated into a qualitative representation (such as low, medium, high, and critical)
                  to help organizations properly assess and prioritize their vulnerability management processes.</p>
                <p>CVSS affords three important benefits:</p>
                <ul>
                  <li>It provides standardized vulnerability scores.
                    When an organization uses a common algorithm for scoring vulnerabilities across all IT platforms,
                    it can leverage a single vulnerability management policy defining the maximum allowable time to validate and remediate a given vulnerability.</li>
                  <li>It provides an open framework. Users may be confused when a vulnerability is assigned an arbitrary score by a third party.
                    With CVSS, the individual characteristics used to derive a score are transparent.</li>
                  <li>CVSS helps prioritize risk. When the environmental score is computed, the vulnerability becomes contextual to each organization,
                    and helps provide a better understanding of the risk posed by a vulnerability to the organization.</li>
                </ul>
              </div>
            </div>
          </div>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div id="cvssboard"></div>
  </div>
</div>
@endsection
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<!--cvss-->
{!!Html::script('js/cvss.js')!!}
<script type="text/javascript">
  $(document).ready(function() {
    var c = new CVSS("cvssboard", {
        onchange: function() {
            window.location.hash = c.get().vector;
            c.vector.setAttribute('href', '#' + c.get().vector)
        }
    });
    if (window.location.hash.substring(1).length > 0) {
        c.set(decodeURIComponent(window.location.hash.substring(1)));
    }
});
</script>
