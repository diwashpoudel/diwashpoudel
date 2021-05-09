@include('admin.partials._header')
<div class="wrapper">

  <!-- Preloader -->
  

  <!-- Navbar -->
  @include('admin.partials._topnav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('admin.partials._sidebar');
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('common.notify')
    <!-- Content Header (Page header) -->
    @yield('main-content')
    <!-- /.content-header -->

    <!-- Main content -->
  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
@include('admin.partials._copyright')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
 @include('admin.partials._script')

 