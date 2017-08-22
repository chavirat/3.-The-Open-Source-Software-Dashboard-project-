<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/favicon.ico">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    {!!Html::style ('css/bootstrap.min.css')!!}
    <!-- font icon -->
    {!!Html::style ('css/font-awesome.css')!!}
    <!-- Custom styles -->
    {!!Html::style ('css/style.css')!!}
    {!!Html::style ('css/sb-admin-2.css')!!}
    <!-- MetisMenu CSS -->
    {!!Html::style ('css/metisMenu.min.css')!!}
    <!--normalize CSS-->
    {!!Html::style ('css/normalize.css')!!}
    @yield('style')
</head>

<body>
    <!-- container section start -->
  <div id="wrapper">
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('layouts.header')
        @include('layouts.sidebar')
      </nav>
      <!--main content start-->
      <div id="page-wrapper" class="page-wrapper">
        @include('inc.message')
          @yield('content')
      </div>
  </div>
  <div class="footer">
       @include('layouts.footer')
  </div>
<!-- javascripts -->
{!!Html::script('js/jquery.js')!!}
<!-- bootstrap -->
{!!Html::script('js/bootstrap.min.js')!!}
<!-- jQuery full calendar -->
{!!Html::script('js/fullcalendar.min.js')!!}
<!-- Custom Theme JavaScript -->
{!!Html::script('js/sb-admin-2.js')!!}
<!-- Metis Menu Plugin JavaScript -->
{!!Html::script('js/metisMenu.min.js')!!}
<!--json-to-table-->
{!!Html::script('js/json-table.js')!!}
@yield('script')
<script>
$(document).ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
});
</script>
</body>
</html>
