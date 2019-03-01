<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    
    @include('includes.headTags')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php  use App\Clasess\UserClass;?>
@guest
@else
    <?php
        $user      = new UserClass;

        $getname    = $user->getNameUser(\Auth::user()->id);
    ?>
@endguest
    <div class="wrapper">
        @include('includes.header')
        @include('includes.sidebar')
            @yield('content')
    </div>
    @include('includes.footTags')

    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
</body>
</html>
