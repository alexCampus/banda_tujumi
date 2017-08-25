<!DOCTYPE html>
<html lang="fr">

<head>

    @include('includes.head')

</head>

<body>
    @include('includes.navbar')
    


    @include('includes.header')
    
    @yield('content')

    @include('includes.footer')

    @include('includes.script')
</body>

</html>
