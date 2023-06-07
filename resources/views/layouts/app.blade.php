<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IAI Ibrahimy | {{$title}}</title>
  <link rel="icon" type="image/png" sizes="16x16" href="../../img/favicon-16x16.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{asset('vendor/plugins/fontawesome-free/css/all.min.css')}}>
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href={{asset('vendor/dist/css/adminlte.min.css')}}>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <x-application-logo/>
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  {{$slot}}
    </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src={{asset('vendor/plugins/jquery/jquery.min.js')}}></script>
<!-- Bootstrap -->
<script src={{asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}></script>
<!-- AdminLTE -->
<script src={{asset('vendor/dist/js/adminlte.js')}}></script>

<!-- OPTIONAL SCRIPTS -->
<script src={{asset('vendor/plugins/chart.js/Chart.min.js')}}></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src={{asset('vendor/dist/js/demo.js')}}></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src={{asset('vendor/dist/js/pages/dashboard3.js')}}></script>
<script>
    window.addEventListener('DOMContentLoaded', function() {
      var currencyCells = document.querySelectorAll('.currency');
      
      currencyCells.forEach(function(cell) {
        var amount = parseFloat(cell.textContent);
        
        if (!isNaN(amount)) {
          var formattedAmount = amount.toLocaleString('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 });
          cell.textContent = formattedAmount;
        }
      });
    });
  </script>
</body>
</html>
