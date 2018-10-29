<!DOCTYPE html>
<html lang="en">

<head>
  @include('BO.includes.head')

</head>

<body>
<button id="btn-wrapper" class="btn"><i class="fa fa-bars"></i></button>
<div id="wrapper" class="">

  @include('BO.includes.sidebar')

  @yield('content')

  @include('BO.includes.script')

  <!-- /#sidebar-wrapper -->



</div>
<!-- /#wrapper -->


</body>

</html>
