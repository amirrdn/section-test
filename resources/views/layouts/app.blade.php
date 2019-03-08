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
    <style>
    input[type="text"], input[type="email"] {
        font-size: 1.6rem;
        color: #010100;
        width: 100%;
        line-height: 65px;
        padding-left: 12px;
    }
    .has-error input[type="text"], .has-error input[type="email"], .has-error select {
        border: 1px solid #a94442;
    }
    #pswd_info {
        color: #fff;
        left: 20px;
        top: 115px;
    }
    .dengertext{
        color: red;
    }


    .valid {
        color: green;
        line-height: 21px;
        padding-left: 22px;
        display: none;
    }

    .invalid {
        color: red;
        line-height: 21px;
    }


    #pswd_info::before {
        content: "";
        height: 25px;
        left: -13px;
        margin-top: -12.5px;
        top: 50%;
        transform: rotate(45deg);
    }
    #pswd_info {
        display:none;
    }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php  
    use App\Clasess\UserClass;
    use Spatie\Permission\Models\Role;;
?>
@guest
@else
    <?php
        $user      = new UserClass;

        $getname    = $user->getNameUser(\Auth::user()->id);
        $user_join  = Role::join('users', 'roles.id', 'users.role_id')->select('roles.name', 'roles.id', 'users.id')->where('users.id',\Auth::user()->id)->first();
        //dd($user_join);
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
