<!DOCTYPE html>
<html lang="fr">

<head>

    @include('FO.includes.head')

</head>

<body>
    @include('FO.includes.navbar')
    


    @include('FO.includes.header')
    
    @yield('content')

    @include('FO.includes.footer')

    @include('FO.includes.script')
</body>

</html>
