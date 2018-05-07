<!DOCTYPE html>
<html lang="en">

<head>
  @include('BO.includes.head')

</head>

<body>
<div id="wrapper" class="toggled">
  @include('BO.includes.sidebar')

  @yield('content')

  @include('BO.includes.script')

  <!-- /#sidebar-wrapper -->



</div>
<!-- /#wrapper -->


</body>

</html>
