@extends('layouts.master')
@section('content')
<div class="row">
  <div class="col-md-12">
      <h1 class="page-header">Latest CVE Reported</h1>
      <iframe src="http://www.cvedetails.com/widget.php?numrows=30&vendor_id=0&product_id=0&version_id=0&hasexp=0&opec=0&opov=0&opcsrf=0&opfileinc=0&opgpriv=0&opsqli=0&opxss=0&opdirt=0&opmemc=0&ophttprs=0&opbyp=0&opginf=0&opdos=0&orderby=3&cvssscoremin=0"
      width="100%" height="500px"></iframe>
  </div>
  <div class="col-md-12">
    <p class="small text-muted">CVE is a registred trademark of the MITRE Corporation and the authoritative source of CVE content is MITRE's CVE web site.
      CWE is a registred trademark of the MITRE Corporation and the authoritative source of CWE content is MITRE's CWE web site.
      OVAL is a registered trademark of The MITRE Corporation and the authoritative source of OVAL content is MITRE's OVAL web site.</p>
    <p class="small text-muted">Use of this information constitutes acceptance for use in an AS IS condition.
      There are NO warranties, implied or otherwise, with regard to this information or its use.
      Any use of this information is at the user's risk. It is the responsibility of user to evaluate the accuracy,
      completeness or usefulness of any information, opinion, advice or other content.
      EACH USER WILL BE SOLELY RESPONSIBLE FOR ANY consequences of his or her direct or indirect use of this web site.
      ALL WARRANTIES OF ANY KIND ARE EXPRESSLY DISCLAIMED. This site will NOT BE LIABLE FOR ANY DIRECT, INDIRECT or any other kind of loss.</p>
  </div>
</div>
@endsection
<script>

</script>
